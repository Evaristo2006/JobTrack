<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Goal;
use App\Models\Interview;
use App\Models\Status;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::id();

        // -------------------------
        // Estatísticas gerais
        // -------------------------
        $totalApplications = Application::where('user_id', $userId)->count();

        $analyzing = Application::where('user_id', $userId)
            ->whereHas('status', fn($q) => $q->where('name', 'Em Análise'))
            ->count();

        $accepted = Application::where('user_id', $userId)
            ->whereHas('status', fn($q) => $q->where('name', 'Aceita'))
            ->count();

        $interviews = Interview::whereHas('application', fn($q) => $q->where('user_id', $userId))->count();

        // -------------------------
        // Últimas metas com progresso
        // -------------------------
        $goals = Goal::where('user_id', $userId)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->take(5)
            ->get();

        foreach ($goals as $goal) {
            $applicationsCount = Application::where('user_id', $userId)
                ->whereYear('applied_at', $goal->year)
                ->whereMonth('applied_at', $goal->month)
                ->count();

            $goal->progress_count = $applicationsCount;
            $goal->progress_percent = $goal->target > 0
                ? round(($applicationsCount / $goal->target) * 100, 2)
                : 0;
        }

        // -------------------------
        // Gráfico de metas dos últimos 6 meses
        // -------------------------
        $chartLabels = [];
        $chartTargets = [];
        $chartProgress = [];

        $lastSixGoals = Goal::where('user_id', $userId)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->take(6)
            ->get()
            ->sortBy('year')
            ->sortBy('month');

        foreach ($lastSixGoals as $g) {
            $chartLabels[] = $g->month . '/' . $g->year;
            $chartTargets[] = $g->target;

            $applicationsCount = Application::where('user_id', $userId)
                ->whereYear('applied_at', $g->year)
                ->whereMonth('applied_at', $g->month)
                ->count();

            $chartProgress[] = $applicationsCount;
        }

        // -------------------------
        // Gráfico diário de candidaturas do mês atual
        // -------------------------
        $daysInMonth = Carbon::now()->daysInMonth;
        $dailyLabels = [];
        $dailyApplications = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dailyLabels[] = $day;
            $count = Application::where('user_id', $userId)
                ->whereYear('applied_at', Carbon::now()->year)
                ->whereMonth('applied_at', Carbon::now()->month)
                ->whereDay('applied_at', $day)
                ->count();
            $dailyApplications[] = $count;
        }

        return view('home.index', compact(
            'totalApplications',
            'analyzing',
            'accepted',
            'interviews',
            'goals',
            'chartLabels',
            'chartTargets',
            'chartProgress',
            'dailyLabels',
            'dailyApplications'
        ));
    }
}
