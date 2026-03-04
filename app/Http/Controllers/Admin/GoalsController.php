<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalsController extends Controller
{
    public function index()
    {
        // Mostrar apenas metas do usuário autenticado
        $goals = Goal::where('user_id', Auth::user()->id)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(10);

        // 🔥 Calcular progresso de cada meta
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

        // Dados para gráfico (últimos 6 meses)
        $chartLabels = [];
        $chartTargets = [];
        $chartProgress = [];

        $lastSixGoals = Goal::where('user_id', Auth::user()->id)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->take(6)
            ->get()
            ->sortBy('year')
            ->sortBy('month');

        foreach ($lastSixGoals as $g) {
            $chartLabels[] = $g->month . '/' . $g->year;
            $chartTargets[] = $g->target;

            $applicationsCount = Application::where('user_id', Auth::user()->id)
                ->whereYear('applied_at', $g->year)
                ->whereMonth('applied_at', $g->month)
                ->count();

            $chartProgress[] = $applicationsCount;
        }

        return view('admin.goals.index', compact('goals', 'chartLabels', 'chartTargets', 'chartProgress'));
    }

    public function create()
    {
        return view('admin.goals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'month'=>'required|integer|min:1|max:12',
            'year'=>'required|integer',
            'target'=>'required|integer|min:1',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        Goal::create($data);

        return redirect()->route('goals.index')->with('success','Meta criada!');
    }

    public function edit(Goal $goal)
    {
        if ($goal->user_id !== Auth::user()->id) {
            abort(403, 'Não autorizado');
        }

        return view('admin.goals.edit', compact('goal'));
    }

    public function update(Request $request, Goal $goal)
    {
        if ($goal->user_id !== Auth::user()->id) {
            abort(403, 'Não autorizado');
        }

        $request->validate([
            'month'=>'required|integer|min:1|max:12',
            'year'=>'required|integer',
            'target'=>'required|integer|min:1',
        ]);

        $data = $request->all();
        $data['user_id'] = $goal->user_id;

        $goal->update($data);

        return redirect()->route('goals.index')->with('success','Meta atualizada!');
    }

    public function destroy(Goal $goal)
    {
        if ($goal->user_id !== Auth::user()->id) {
            abort(403, 'Não autorizado');
        }

        $goal->delete();
        return redirect()->route('goals.index')->with('success','Meta deletada!');
    }
}
