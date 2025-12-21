<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan ini agar lebih lengkap
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Club extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'clubs';

    protected $fillable = [
        'name',         // Sebelumnya: nama_klub
        'province',     // Sebelumnya: provinsi
        'city',         // Sebelumnya: kota
        'address',      // Sebelumnya: alamat_klub
        'phone',        // Sebelumnya: kontak_club
        'email',        // Sebelumnya: email_resmi
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi: Satu Club memiliki banyak Athlete.
     * Kita tambahkan ini agar koneksi ke model Athlete tadi nyambung.
     */
    public function athletes()
    {
        return $this->hasMany(Athlete::class);
    }
}