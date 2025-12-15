<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Club extends Authenticatable
{
    use Notifiable;

    protected $table = 'clubs';

    protected $fillable = [
        'nama_klub',
        'provinsi',
        'kota',
        'alamat_klub',
        'kontak_club',
        'email_resmi',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
