<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return view('admin.statuses.index', compact('statuses'));
    }

    public function create()
    {
        return view('admin.statuses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:50',
            'color'=>'nullable|string|max:10'
        ]);

        Status::create($request->all());
        return redirect()->route('statuses.index')->with('success','Status criado!');
    }

    public function edit(Status $status)
    {
        return view('admin.statuses.edit', compact('status'));
    }

    public function update(Request $request, Status $status)
    {
        $request->validate([
            'name'=>'required|string|max:50',
            'color'=>'nullable|string|max:10'
        ]);

        $status->update($request->all());
        return redirect()->route('statuses.index')->with('success','Status atualizado!');
    }

    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->route('statuses.index')->with('success','Status deletado!');
    }
}
