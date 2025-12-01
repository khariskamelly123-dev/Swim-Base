<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class club extends Model
{
    protected $table = 'club_data';

    protected $fillable = [
        'nama_klub',
        'alamat_klub',
        'kontak_club',
        'email_resmi',
        'pelatih',
        'password'
    ];

    protected $hidden = [
        'password'
    ];
}
