<?php

namespace App\Http\Controllers;

use App\Models\GymNews;
use Illuminate\Http\Request;

class GymNewsController extends Controller
{
    public function index()
    {
        $events = GymNews::orderBy('event_date', 'asc')->get();
        return view('gym-news.index', compact('events'));
    }

    public function create()
    {
        return view('gym-news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
        ]);

        GymNews::create($request->only(['title', 'description', 'event_date']));

        return redirect()->route('gym-news.index')
            ->with('success', __('messages.events.created'));
    }

    public function edit($id)
    {
        $event = GymNews::findOrFail($id);
        return view('gym-news.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
        ]);

        $event = GymNews::findOrFail($id);
        $event->update($request->only(['title', 'description', 'event_date']));

        return redirect()->route('gym-news.index')
            ->with('success', __('messages.events.updated'));
    }

    public function destroy($id)
    {
        $event = GymNews::findOrFail($id);
        $event->delete();

        return redirect()->route('gym-news.index')
            ->with('success', __('messages.events.deleted'));
    }
}
