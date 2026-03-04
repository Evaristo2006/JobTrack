<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function index()
    {
        $applications = Application::with(['user','status'])->orderBy('applied_at','desc')->paginate(10);
        return view('admin.applications.index', compact('applications'));
    }

    public function create()
    {
        $users = User::all();
        $statuses = Status::all();
        return view('admin.applications.create', compact('users','statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required|exists:users,id',
            'status_id'=>'required|exists:statuses,id',
            'company'=>'required|string|max:255',
            'position'=>'required|string|max:255',
            'location'=>'nullable|string|max:255',
            'type'=>'nullable|string|max:50',
            'salary'=>'nullable|numeric',
            'applied_at'=>'required|date',
            'job_url'=>'nullable|url',
            'notes'=>'nullable|string',
        ]);

        Application::create($request->all());

        return redirect()->route('applications.index')->with('success','Candidatura criada!');
    }

    public function edit(Application $application)
    {
        $users = User::all();
        $statuses = Status::all();
        return view('admin.applications.edit', compact('application','users','statuses'));
    }

    public function update(Request $request, Application $application)
    {
        $request->validate([
            'user_id'=>'required|exists:users,id',
            'status_id'=>'required|exists:statuses,id',
            'company'=>'required|string|max:255',
            'position'=>'required|string|max:255',
            'location'=>'nullable|string|max:255',
            'type'=>'nullable|string|max:50',
            'salary'=>'nullable|numeric',
            'applied_at'=>'required|date',
            'job_url'=>'nullable|url',
            'notes'=>'nullable|string',
        ]);

        $application->update($request->all());
        return redirect()->route('applications.index')->with('success','Candidatura atualizada!');
    }

    public function destroy(Application $application)
    {
        $application->delete();
        return redirect()->route('applications.index')->with('success','Candidatura deletada!');
    }
}
