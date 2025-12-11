<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasis';

    protected $fillable = [
        'atlet_id',
        'klub_id',
        'event_id',
        'kategori_id',
        'medal',
        'posisi',
        'record_value',
        'tanggal',
        'created_by',
        'note',
    ];
}
