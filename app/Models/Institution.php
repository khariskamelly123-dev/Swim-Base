<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Institution extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel standar jamak
    protected $table = 'institutions';

    protected $fillable = [
        'name',     // Sebelumnya: nama_sekolah_universitas
        'type',
        'address',  // Sebelumnya: alamat_sekolah_universitas
        'phone',    // Sebelumnya: kontak_seko_univ
        'email',    // Sebelumnya: email_resmi... (Harus unique)
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // OPSI: Jika Institusi punya relasi ke Atlet (misal atlet sekolah di sini)
    // public function athletes() {
    //     return $this->hasMany(Athlete::class);
    // }
}