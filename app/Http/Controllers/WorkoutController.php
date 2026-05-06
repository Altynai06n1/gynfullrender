<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function index()
    {
        $projects = Workout::latest()->get();
        return view('workouts.index', compact('projects'));
    }

    public function create()
    {
        return view('workouts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Workout::create($request->only(['title', 'description']));

        return redirect()->route('workouts.index')
            ->with('success', __('messages.workouts.created'));
    }

    public function edit($id)
    {
        $project = Workout::findOrFail($id);
        return view('workouts.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project = Workout::findOrFail($id);
        $project->update($request->only(['title', 'description']));

        return redirect()->route('workouts.index')
            ->with('success', __('messages.workouts.updated'));
    }

    public function destroy($id)
    {
        $project = Workout::findOrFail($id);
        $project->delete();

        return redirect()->route('workouts.index')
            ->with('success', __('messages.workouts.deleted'));
    }
}
