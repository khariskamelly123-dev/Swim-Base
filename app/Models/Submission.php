<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $table = 'submissions';

    protected $fillable = [
        'athlete_id',       // Sebelumnya: atlet_id
        'club_id',          // Sebelumnya: club_id
        'submission_type',  // Sebelumnya: tipe_pengajuan
        'new_data',         // Sebelumnya: data_baru
        'reason',           // Sebelumnya: alasan
        'status',
        'approved_by',
        'notes'             // Sebelumnya: catatan
    ];

    // Konversi JSON dari database langsung jadi Array di PHP
    protected $casts = [
        'new_data' => 'array',
    ];

    /**
     * Relasi ke Athlete
     * Penting: Sekarang gunakan model 'Athlete', bukan 'Atlet' lagi.
     */
    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }

    /**
     * Relasi ke Club
     * Karena ada club_id, sebaiknya buat relasinya juga.
     */
    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    /**
     * Relasi ke Admin/User yang menyetujui (Approver)
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}