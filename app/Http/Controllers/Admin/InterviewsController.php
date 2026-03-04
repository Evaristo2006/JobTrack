<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewsController extends Controller
{
    public function index()
    {
        // Mostrar apenas entrevistas do usuário autenticado
        $interviews = Interview::whereHas('application', function($q) {
            $q->where('user_id', Auth::user()->id);
        })
        ->with('application')
        ->orderBy('interview_date', 'desc')
        ->paginate(10);

        return view('admin.interviews.index', compact('interviews'));
    }

    public function create()
    {
        // Mostrar apenas candidaturas do usuário autenticado
        $applications = Application::where('user_id', Auth::user()->id)->get();
        return view('admin.interviews.create', compact('applications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'application_id'=>'required|exists:applications,id',
            'interview_date'=>'required|date',
            'type'=>'nullable|string|max:50',
            'feedback'=>'nullable|string',
            'passed'=>'nullable|boolean',
        ]);

        Interview::create($request->all());

        return redirect()->route('interviews.index')->with('success','Entrevista criada!');
    }

    public function edit(Interview $interview)
    {
        // Verifica se a entrevista pertence ao usuário autenticado
        if ($interview->application->user_id !== Auth::user()->id) {
            abort(403, 'Não autorizado');
        }

        $applications = Application::where('user_id', Auth::user()->id)->get();
        return view('admin.interviews.edit', compact('interview', 'applications'));
    }

    public function update(Request $request, Interview $interview)
    {
        // Verifica se a entrevista pertence ao usuário autenticado
        if ($interview->application->user_id !== Auth::user()->id) {
            abort(403, 'Não autorizado');
        }

        $request->validate([
            'application_id'=>'required|exists:applications,id',
            'interview_date'=>'required|date',
            'type'=>'nullable|string|max:50',
            'feedback'=>'nullable|string',
            'passed'=>'nullable|boolean',
        ]);

        $interview->update($request->all());

        return redirect()->route('interviews.index')->with('success','Entrevista atualizada!');
    }

    public function destroy(Interview $interview)
    {
        // Verifica se a entrevista pertence ao usuário autenticado
        if ($interview->application->user_id !== Auth::user()->id) {
            abort(403, 'Não autorizado');
        }

        $interview->delete();
        return redirect()->route('interviews.index')->with('success','Entrevista deletada!');
    }
}
