<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Atlet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    // ==========================================
    // BAGIAN ADMIN (Melihat Daftar Pengajuan)
    // ==========================================
    public function index()
    {
        // Menampilkan semua pengajuan yang statusnya 'pending'
        // Relasi 'club' dan 'atlet' diasumsikan sudah ada di Model Pengajuan
        $pengajuan = Pengajuan::with(['club', 'atlet'])
                        ->where('status', 'pending')
                        ->latest()
                        ->get();

        return view('admin.pengajuan.index', compact('pengajuan'));
    }

    // ==========================================
    // BAGIAN KLUB (Mengirim Pengajuan)
    // ==========================================

    // Menampilkan Form Edit (Sebenarnya bisa pakai AtletController@edit)
    public function formEdit($id)
    {
        $atlet = Atlet::findOrFail($id);
        // Pastikan atlet milik klub yang login
        if ($atlet->klub_id != Auth::guard('club')->id()) {
            abort(403, 'Anda tidak berhak mengedit atlet ini.');
        }
        return view('atlet.edit', compact('atlet'));
    }

    // PROSES: Simpan request Edit ke Database Pengajuan
    public function pengajuanEdit(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'            => 'required|string',
            'tempat_lahir'    => 'required|string',
            'tanggal_lahir'   => 'required|date',
            'cabang_olahraga' => 'required|string',
            'alasan'          => 'required|string',
        ]);

        // Pisahkan 'alasan' dari data atlet yang mau diupdate
        $dataAtlet = $request->except(['_token', 'alasan', '_method']);

        Pengajuan::create([
            'club_id'         => Auth::guard('club')->id(),
            'related_id'      => $id,          // ID Atlet yang mau diedit
            'related_table'   => 'atlets',     // Nama tabel
            'jenis_pengajuan' => 'update',
            'data_pengajuan'  => json_encode($dataAtlet), // Simpan data baru sebagai JSON
            'alasan'          => $request->alasan,
            'status'          => 'pending',
        ]);

        return redirect()->route('atlet.index')
            ->with('success', 'Perubahan data berhasil diajukan. Menunggu persetujuan Admin.');
    }

    // Menampilkan Form Konfirmasi Hapus (Opsional, jika ingin halaman khusus)
    public function formHapus($id)
    {
        $atlet = Atlet::findOrFail($id);
        return view('atlet.hapus_konfirmasi', compact('atlet'));
    }

    // PROSES: Simpan request Hapus ke Database Pengajuan
    public function pengajuanHapus(Request $request, $id)
    {
        // Cek duplikasi pengajuan
        $isPending = Pengajuan::where('related_id', $id)
                        ->where('jenis_pengajuan', 'delete')
                        ->where('status', 'pending')
                        ->exists();

        if ($isPending) {
            return back()->with('error', 'Penghapusan atlet ini sedang diproses.');
        }

        Pengajuan::create([
            'club_id'         => Auth::guard('club')->id(),
            'related_id'      => $id,
            'related_table'   => 'atlets',
            'jenis_pengajuan' => 'delete',
            'data_pengajuan'  => null, // Hapus tidak butuh data baru
            'alasan'          => 'Permintaan penghapusan oleh Klub', // Atau ambil dari input form jika ada
            'status'          => 'pending',
        ]);

        return redirect()->route('atlet.index')
            ->with('success', 'Permintaan hapus atlet telah dikirim ke Admin.');
    }

    // ==========================================
    // BAGIAN ADMIN (Eksekusi / Approval)
    // ==========================================

    public function approve($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        if ($pengajuan->status !== 'pending') {
            return back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        DB::beginTransaction(); // Pakai transaksi biar aman
        try {
            // 1. Jika Pengajuannya adalah UPDATE
            if ($pengajuan->jenis_pengajuan == 'update') {
                
                // Ambil data JSON, ubah jadi Array
                $dataBaru = json_decode($pengajuan->data_pengajuan, true);
                
                // Update tabel Atlet yang asli
                Atlet::where('id', $pengajuan->related_id)->update($dataBaru);
            } 
            // 2. Jika Pengajuannya adalah DELETE
            elseif ($pengajuan->jenis_pengajuan == 'delete') {
                
                // Hapus data di tabel Atlet yang asli
                Atlet::destroy($pengajuan->related_id);
            }

            // 3. Ubah status pengajuan jadi Approved
            $pengajuan->update(['status' => 'approved']);
            
            DB::commit();
            return back()->with('success', 'Pengajuan berhasil disetujui dan data telah diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function reject($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        
        // Cukup ubah status jadi rejected
        $pengajuan->update(['status' => 'rejected']);

        return back()->with('success', 'Pengajuan telah ditolak.');
    }
}