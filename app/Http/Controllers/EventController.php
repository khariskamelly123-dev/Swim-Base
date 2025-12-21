<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // ==========================================================
    // BAGIAN API (JSON) - Untuk Mobile / AJAX
    // ==========================================================

    public function index()
    {
        // Menggunakan nama relasi baru 'category'
        $events = Event::with(['category', 'organizer'])
                       ->orderBy('start_date', 'desc')
                       ->get();

        return response()->json($events);
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (Sesuai kolom database baru)
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|unique:events,slug',
            'category_id' => 'required|exists:categories,id', // Dulu: kategori_id
            'location'    => 'required|string',             // Dulu: lokasi
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        // 2. Tambahkan Data Tambahan (Organizer & Status)
        $data = $validated;
        $data['organizer_id'] = Auth::id(); // Ambil ID Admin yang sedang login
        $data['status']       = 'upcoming'; // Default status

        // 3. Simpan
        $event = Event::create($data);

        return response()->json([
            'message' => 'Event created successfully',
            'data'    => $event
        ], 201);
    }

    public function show($id)
    {
        // Relasi 'category'
        return response()->json(Event::with('category')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'slug'        => "sometimes|required|string|unique:events,slug,$id",
            'category_id' => 'sometimes|required|exists:categories,id',
            'location'    => 'sometimes|required|string',
            'start_date'  => 'sometimes|required|date',
            'end_date'    => 'sometimes|required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'status'      => 'nullable|string', // Bisa update status (upcoming, ongoing, completed)
        ]);

        $event->update($validated);

        return response()->json([
            'message' => 'Event updated successfully',
            'data'    => $event
        ]);
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return response()->json(['deleted' => true, 'message' => 'Event deleted successfully']);
    }

    // ==========================================================
    // BAGIAN VIEW ADMIN (HTML) - Sesuai route web.php
    // ==========================================================

    /**
     * Menampilkan Halaman Manajemen Event di Dashboard Admin
     * Route: admin.event.list
     */
    public function indexAdmin()
    {
        $events = Event::with('category')->latest('start_date')->get();
        
        // Pastikan kamu punya file: resources/views/admin/event/index.blade.php
        return view('admin.event.index', compact('events'));
    }
}