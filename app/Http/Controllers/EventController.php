<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        return response()->json(Event::with('kategori')->orderBy('start_date','desc')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:events,slug',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $event = Event::create($validated + ['description' => $request->input('description'), 'kategori_id' => $request->input('kategori_id')]);
        return response()->json($event, 201);
    }

    public function show($id)
    {
        return response()->json(Event::with('kategori')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'slug' => "sometimes|required|string|unique:events,slug,$id",
        ]);
        $event->update($validated);
        return response()->json($event);
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return response()->json(['deleted' => true]);
    }
}
