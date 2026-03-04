<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\Application;
use Illuminate\Http\Request;

class InterviewsController extends Controller
{
    public function index()
    {
        $interviews = Interview::with('application')->orderBy('interview_date','desc')->paginate(10);
        return view('admin.interviews.index', compact('interviews'));
    }

    public function create()
    {
        $applications = Application::all();
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
        $applications = Application::all();
        return view('admin.interviews.edit', compact('interview','applications'));
    }

    public function update(Request $request, Interview $interview)
    {
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
        $interview->delete();
        return redirect()->route('interviews.index')->with('success','Entrevista deletada!');
    }
}
