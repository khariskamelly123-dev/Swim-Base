<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement; // Model Baru
use App\Models\Athlete;     // Untuk ambil data klub atlet
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{
    /**
     * Menampilkan daftar prestasi (API Format)
     */
    public function index()
    {
        // Menggunakan relasi bahasa Inggris: athlete, club, event
        $achievements = Achievement::with(['athlete', 'club', 'event'])
                                   ->orderBy('date', 'desc') // 'tanggal' -> 'date'
                                   ->get();

        return response()->json($achievements);
    }

    /**
     * Menyimpan Prestasi Baru
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (Gunakan nama field bahasa Inggris)
        $validated = $request->validate([
            'athlete_id'    => 'required|exists:athletes,id',
            'event_id'      => 'nullable|exists:events,id',
            'category_id'   => 'nullable|exists:categories,id', // Tambahan jika ada kategori
            'medal'         => 'nullable|in:Gold,Silver,Bronze,None',
            'position'      => 'nullable|integer',  // 'posisi' -> 'position'
            'record_value'  => 'nullable|string',   // Waktu/Skor
            'date'          => 'required|date',     // 'tanggal' -> 'date'
            'notes'         => 'nullable|string',
        ]);

        // 2. Ambil Data Atlet untuk mengetahui Club ID-nya
        $athlete = Athlete::findOrFail($request->athlete_id);

        // 3. Gabungkan Data
        $dataToSave = array_merge($validated, [
            'club_id'    => $athlete->club_id, // Otomatis isi club_id sesuai atletnya
            'created_by' => Auth::id(),        // User yang menginput
        ]);

        // 4. Simpan ke Database
        $achievement = Achievement::create($dataToSave);

        return response()->json([
            'message' => 'Achievement created successfully',
            'data'    => $achievement
        ], 201);
    }

    /**
     * Menampilkan Detail Prestasi
     */
    public function show($id)
    {
        $achievement = Achievement::with(['athlete', 'club', 'event'])->findOrFail($id);
        return response()->json($achievement);
    }

    /**
     * Update Data Prestasi
     */
    public function update(Request $request, $id)
    {
        $achievement = Achievement::findOrFail($id);

        $validated = $request->validate([
            'medal'        => 'nullable|in:Gold,Silver,Bronze,None',
            'position'     => 'nullable|integer',
            'record_value' => 'nullable|string',
            'date'         => 'nullable|date',
            'notes'        => 'nullable|string',
        ]);

        $achievement->update($validated);

        return response()->json([
            'message' => 'Achievement updated successfully',
            'data'    => $achievement
        ]);
    }

    /**
     * Hapus Data Prestasi
     */
    public function destroy($id)
    {
        Achievement::findOrFail($id)->delete();
        
        return response()->json([
            'message' => 'Achievement deleted successfully',
            'deleted' => true
        ]);
    }
    
    // ==========================================================
    // TAMBAHAN: JIKA BUTUH UNTUK FORM WEB (BUKAN API JSON)
    // ==========================================================
    
    // Method untuk menampilkan Form Input (Sesuai route di web.php)
    public function inputForm()
    {
        // Load data pendukung untuk dropdown select
        $athletes = Athlete::all();
        $events = \App\Models\Event::all();
        return view('admin.achievement.input', compact('athletes', 'events'));
        
        return response()->json(['message' => 'This is View Placeholder. Create create.blade.php']);
    }
}