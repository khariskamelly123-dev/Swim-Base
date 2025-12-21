<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admins'; // Nama tabel di database

    protected $fillable = [
        'name',
        'email',
        'password',
        // Tambah kolom lain jika perlu, misal 'phone'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}