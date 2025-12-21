<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Athlete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    /**
     * [ADMIN] Menampilkan daftar pengajuan yang masih Pending
     */
    public function index()
    {
        // Ambil pengajuan status 'pending' dengan relasi club & athlete agar query ringan
        $submissions = Submission::with(['club', 'athlete'])
                        ->where('status', 'pending')
                        ->latest()
                        ->get();

        // Pastikan view folder sudah direname jadi resources/views/admin/submission/
        return view('admin.submission.index', compact('submissions'));
    }

    /**
     * [CLUB] Melihat riwayat/status pengajuan saya
     */
    public function mySubmissions()
    {
        $clubId = Auth::guard('club')->id();

        $submissions = Submission::with('athlete')
                        ->where('club_id', $clubId)
                        ->latest()
                        ->get();

        return view('club.submission.status', compact('submissions'));
    }

    /**
     * [ADMIN] Menyetujui Pengajuan (Approve)
     */
    public function approve($id)
    {
        $submission = Submission::findOrFail($id);

        if ($submission->status !== 'pending') {
            return back()->with('error', 'This submission has already been processed.');
        }

        DB::beginTransaction(); // Mulai Transaksi Database
        try {
            // 1. Eksekusi Perubahan Data Berdasarkan Tipe Pengajuan
            if ($submission->submission_type == 'update') {
                
                // Ambil data baru (sudah otomatis jadi array karena casts di Model)
                $newData = $submission->new_data;

                // Update data di tabel Athlete asli
                $athlete = Athlete::findOrFail($submission->athlete_id);
                $athlete->update($newData);

            } elseif ($submission->submission_type == 'delete') {
                
                // Hapus data di tabel Athlete asli
                Athlete::destroy($submission->athlete_id);
            }

            // 2. Update Status Pengajuan jadi Approved
            $submission->update([
                'status'      => 'approved',
                'approved_by' => Auth::id(), // ID Admin yang sedang login
                'notes'       => 'Approved by Admin',
            ]);

            DB::commit(); // Simpan perubahan permanen
            return back()->with('success', 'Request approved and data updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan jika ada error
            return back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    /**
     * [ADMIN] Menolak Pengajuan (Reject)
     */
    public function reject(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);

        if ($submission->status !== 'pending') {
            return back()->with('error', 'This submission has already been processed.');
        }

        // Update status jadi Rejected
        $submission->update([
            'status'      => 'rejected',
            'approved_by' => Auth::id(), // Admin yang menolak
            'notes'       => $request->input('notes', 'Rejected by Admin'), // Alasan penolakan (opsional)
        ]);

        return back()->with('success', 'Request has been rejected.');
    }
}