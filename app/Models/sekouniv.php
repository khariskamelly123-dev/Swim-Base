<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class sekouniv extends Authenticatable
{
    protected $table = 'seko_univ_data';

    protected $fillable = [
        'nama_sekolah_universitas',
        'alamat_sekolah_universitas',
        'kontak_seko_univ',
        'email_resmi_seko_univ',
        'password'
    ];

    protected $hidden = [
        'password'
    ];
}
