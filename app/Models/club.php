<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Club extends Authenticatable
{
    use Notifiable;

    protected $table = 'club_data';

    protected $fillable = [
        'nama_klub',
        'alamat_klub',
        'kontak_club',
        'email_resmi',
        'pelatih',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
