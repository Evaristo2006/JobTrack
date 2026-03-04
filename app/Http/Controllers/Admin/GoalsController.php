<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Http\Request;

class GoalsController extends Controller
{
    public function index()
    {
        $goals = Goal::with('user')->orderBy('year','desc')->orderBy('month','desc')->paginate(10);
        return view('admin.goals.index', compact('goals'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.goals.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required|exists:users,id',
            'month'=>'required|integer|min:1|max:12',
            'year'=>'required|integer',
            'target'=>'required|integer|min:1',
        ]);

        Goal::create($request->all());

        return redirect()->route('goals.index')->with('success','Meta criada!');
    }

    public function edit(Goal $goal)
    {
        $users = User::all();
        return view('admin.goals.edit', compact('goal','users'));
    }

    public function update(Request $request, Goal $goal)
    {
        $request->validate([
            'user_id'=>'required|exists:users,id',
            'month'=>'required|integer|min:1|max:12',
            'year'=>'required|integer',
            'target'=>'required|integer|min:1',
        ]);

        $goal->update($request->all());

        return redirect()->route('goals.index')->with('success','Meta atualizada!');
    }

    public function destroy(Goal $goal)
    {
        $goal->delete();
        return redirect()->route('goals.index')->with('success','Meta deletada!');
    }
}
