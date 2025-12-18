<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atlet;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class AtletController extends Controller
{
    public function index()
{
    $klubId = Auth::guard('club')->id();

    $atlet = Atlet::where('klub_id', $klubId)->orderBy('nama')->get(); 
    $total_atlet = $atlet->count();

    return view('atlet.index', compact('total_atlet', 'atlet'));
}

    public function create()
    {
        return view('atlet.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'tempat_lahir'    => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'cabang_olahraga' => 'nullable|string'
        ]);

        Atlet::create([
            'klub_id' => Auth::guard('club')->id(),
            'nama' => $request->nama,
            'tempat_lahir'    => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kategori_renang' => $request->kategori_renang
        ]);

        return redirect()->route('atlet.index')->with('success', 'Atlet berhasil ditambahkan');
    }

    // SuperAdmin only edit (direct)
    public function edit($id)
    {
        $atlet = Atlet::findOrFail($id);
        return view('atlet.edit', compact('atlet'));
    }

        public function ajukan_update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'cabang_olahraga' => 'required|string',
            'alasan' => 'required|string',
        ]);

        // Simpan ke tabel PENGAJUAN
        Pengajuan::create([
            'club_id' => Auth::guard('club')->id(),
            // Simpan ID atlet yang mau diedit (Bisa di kolom khusus atau digabung di json)
            'related_id' => $id, 
            'related_table' => 'atlets', // Opsional, biar tau ini pengajuan soal tabel apa
            
            'jenis_pengajuan' => 'update', // atau 'edit'
            
            // Data baru kita simpan dalam bentuk JSON text
            'data_pengajuan' => json_encode($validated),
            
            'alasan' => $validated['alasan'],
            'status' => 'pending', // Status awal
        ]);

        return redirect()->route('atlet.index')->with('success', 'Perubahan data berhasil diajukan. Menunggu persetujuan Admin.');
    }

    // 2. PROSES AJUKAN HAPUS (Dari Tombol Hapus di Index)
    public function ajukan_delete(Request $request, $id)
    {
        // Cek dulu apakah atlet ini sedang dalam proses pengajuan (biar gak double)
        $isPending = Pengajuan::where('related_id', $id)
                        ->where('jenis_pengajuan', 'delete')
                        ->where('status', 'pending')
                        ->exists();

        if($isPending) {
            return back()->with('error', 'Penghapusan atlet ini sudah diajukan sebelumnya.');
        }

        Pengajuan::create([
            'club_id' => Auth::guard('club')->id(),
            'related_id' => $id,
            'related_table' => 'atlets',
            
            'jenis_pengajuan' => 'delete', // atau 'hapus'
            
            'data_pengajuan' => null, // Hapus tidak butuh data baru
            'alasan' => 'Permintaan penghapusan oleh Klub',
            'status' => 'pending',
        ]);

        return redirect()->route('atlet.index')->with('success', 'Permintaan hapus atlet telah dikirim ke Admin.');
    }

}
