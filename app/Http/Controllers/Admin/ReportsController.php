<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportsController extends Controller
{
    public function goalsPdf()
    {
        // Pega metas do usuário
        $goals = Goal::where('user_id', Auth::user()->id)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Calcula progresso de cada meta
        foreach ($goals as $goal) {
            $applicationsCount = Application::where('user_id', Auth::user()->id)
                ->whereYear('applied_at', $goal->year)
                ->whereMonth('applied_at', $goal->month)
                ->count();

            $goal->progress_count = $applicationsCount;
            $goal->progress_percent = $goal->target > 0
                ? round(($applicationsCount / $goal->target) * 100, 2)
                : 0;
        }

        // Renderiza Blade em PDF
        $pdf = Pdf::loadView('admin.reports.pdf', compact('goals'));

        return $pdf->download('relatorio_metas.pdf');
    }
}
