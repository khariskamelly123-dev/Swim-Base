<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atlet extends Model
{
    use HasFactory;

    protected $table = 'atlets';

    protected $fillable = [
        'klub_id',
        'nama',
        'nisn',
        'tanggal_lahir',
        'gender',
        'cabang_olahraga'
    ];

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'atlet_id');
    }
}
