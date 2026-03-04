<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationsController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::where('user_id', Auth::user()->id)
            ->with(['status']);

        // 🔎 Pesquisa geral
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('company', 'like', '%' . $request->search . '%')
                  ->orWhere('position', 'like', '%' . $request->search . '%')
                  ->orWhere('cv_path', 'like', '%' . $request->search . '%');
            });
        }

        // 📌 Filtro por status
        if ($request->status) {
            $query->where('status_id', $request->status);
        }

        // 📅 Filtro por data
        if ($request->date_from) {
            $query->whereDate('applied_at', '>=', $request->date_from);
        }

        if ($request->date_to) {
            $query->whereDate('applied_at', '<=', $request->date_to);
        }

        $applications = $query->orderBy('applied_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $statuses = Status::all();

        return view('admin.applications.index', compact('applications', 'statuses'));
    }

    public function create()
    {
        $statuses = Status::all();
        return view('admin.applications.create', compact('statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'status_id'=>'required|exists:statuses,id',
            'company'=>'required|string|max:255',
            'position'=>'required|string|max:255',
            'location'=>'nullable|string|max:255',
            'type'=>'nullable|string|max:50',
            'salary'=>'nullable|numeric',
            'applied_at'=>'required|date',
            'job_url'=>'nullable|url',
            'notes'=>'nullable|string',
            'cv'=>'nullable|file|mimes:pdf|max:2048', // 🔥 novo
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // 📄 Upload CV
        if ($request->hasFile('cv')) {
            $data['cv_path'] = $request->file('cv')->store('cvs', 'public');
        }

        Application::create($data);

        return redirect()->route('applications.index')
            ->with('success','Candidatura criada!');
    }

    public function edit(Application $application)
    {
        if ($application->user_id !== Auth::user()->id) {
            abort(403, 'Não autorizado');
        }

        $statuses = Status::all();
        return view('admin.applications.edit', compact('application', 'statuses'));
    }

    public function update(Request $request, Application $application)
    {
        if ($application->user_id !== Auth::user()->id) {
            abort(403, 'Não autorizado');
        }

        $request->validate([
            'status_id'=>'required|exists:statuses,id',
            'company'=>'required|string|max:255',
            'position'=>'required|string|max:255',
            'location'=>'nullable|string|max:255',
            'type'=>'nullable|string|max:50',
            'salary'=>'nullable|numeric',
            'applied_at'=>'required|date',
            'job_url'=>'nullable|url',
            'notes'=>'nullable|string',
            'cv'=>'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = $application->user_id;

        // 🔄 Atualizar CV
        if ($request->hasFile('cv')) {

            // Remove CV antigo
            if ($application->cv_path) {
                Storage::disk('public')->delete($application->cv_path);
            }

            $data['cv_path'] = $request->file('cv')->store('cvs', 'public');
        }

        $application->update($data);

        return redirect()->route('applications.index')
            ->with('success','Candidatura atualizada!');
    }

    public function destroy(Application $application)
    {
        if ($application->user_id !== Auth::user()->id) {
            abort(403, 'Não autorizado');
        }

        // 🗑 Remover CV do storage
        if ($application->cv_path) {
            Storage::disk('public')->delete($application->cv_path);
        }

        $application->delete();

        return redirect()->route('applications.index')
            ->with('success','Candidatura deletada!');
    }
}
