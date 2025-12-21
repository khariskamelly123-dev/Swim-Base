<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Athlete;      // Model Baru
use App\Models\Submission;   // Model Baru
use Illuminate\Support\Facades\Auth;

class AthleteController extends Controller
{
    // MENAMPILKAN DAFTAR ATLET
    public function index()
    {
        // Pastikan guard 'club' sudah diatur di config/auth.php
        $clubId = Auth::guard('club')->id();

        // Ambil data atlet milik klub tersebut
        $athletes = Athlete::where('club_id', $clubId)
                            ->orderBy('name') // sorting berdasarkan nama
                            ->get();
        
        $total_athletes = $athletes->count();

        // Pastikan nama folder view juga sudah di-rename jadi 'athlete'
        return view('athlete.index', compact('total_athletes', 'athletes'));
    }

    // FORM TAMBAH ATLET
    public function create()
    {
        return view('athlete.create');
    }

    // PROSES SIMPAN ATLET BARU
    public function store(Request $request)
    {
        // Validasi Input (Sesuaikan name di form HTML nanti)
        $request->validate([
            'name'              => 'required|string|max:255',
            'birth_place'       => 'nullable|string|max:255', // Dulu: tempat_lahir
            'birth_date'        => 'required|date',
            'swimming_category' => 'required|string' // Dulu: cabang_olahraga/kategori_renang
        ]);

        // Simpan ke Database
        Athlete::create([
            'club_id'           => Auth::guard('club')->id(),
            'name'              => $request->name,
            'birth_place'       => $request->birth_place,
            'birth_date'        => $request->birth_date,
            'swimming_category' => $request->swimming_category
        ]);

        return redirect()->route('athlete.index')
                         ->with('success', 'Athlete added successfully (Atlet berhasil ditambahkan)');
    }

    // FORM EDIT (Hanya Tampilan)
    public function edit($id)
    {
        $athlete = Athlete::findOrFail($id);
        
        // Pastikan data ini milik klub yang sedang login (Security Check)
        if ($athlete->club_id != Auth::guard('club')->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('athlete.edit', compact('athlete'));
    }

    // 1. PROSES PENGAJUAN UPDATE (Jika Club ingin edit data)
    public function submitUpdate(Request $request, $id)
    {
        // Validasi data baru yang ingin diajukan
        $validated = $request->validate([
            'name'              => 'required|string',
            'birth_place'       => 'required|string',
            'birth_date'        => 'required|date',
            'swimming_category' => 'required|string',
            'reason'            => 'required|string', // Alasan kenapa diubah
        ]);

        // Pisahkan 'reason' dari data atlet agar tidak masuk ke kolom json data
        $reason = $validated['reason'];
        unset($validated['reason']);

        // Simpan ke tabel SUBMISSIONS
        Submission::create([
            'club_id'         => Auth::guard('club')->id(),
            'athlete_id'      => $id, // ID Atlet yang mau diedit
            
            'submission_type' => 'update', // Tipe pengajuan
            
            // Data baru disimpan otomatis sebagai JSON (karena cast 'array' di model)
            'new_data'        => $validated, 
            
            'reason'          => $reason,
            'status'          => 'pending',
        ]);

        return redirect()->route('athlete.index')
                         ->with('success', 'Update request submitted. Waiting for Admin approval.');
    }

    // 2. PROSES PENGAJUAN HAPUS
    public function submitDelete($id)
    {
        $clubId = Auth::guard('club')->id();

        // Cek apakah sudah ada pengajuan hapus yang pending (biar gak spam)
        $isPending = Submission::where('athlete_id', $id)
                                ->where('club_id', $clubId)
                                ->where('submission_type', 'delete')
                                ->where('status', 'pending')
                                ->exists();

        if($isPending) {
            return back()->with('error', 'Deletion request for this athlete is already pending.');
        }

        // Buat pengajuan hapus
        Submission::create([
            'club_id'         => $clubId,
            'athlete_id'      => $id,
            'submission_type' => 'delete',
            'new_data'        => null, // Hapus tidak butuh data baru
            'reason'          => 'Request to delete by Club',
            'status'          => 'pending',
        ]);

        return redirect()->route('athlete.index')
                         ->with('success', 'Deletion request submitted to Admin.');
    }
}