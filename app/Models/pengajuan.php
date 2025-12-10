<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuans';

    protected $fillable = [
        'atlet_id',
        'klub_id',
        'tipe_pengajuan',
        'data_baru',
        'alasan',
        'status',
        'approved_by',
        'catatan'
    ];

    protected $casts = [
        'data_baru' => 'array'
    ];

    public function atlet()
    {
        return $this->belongsTo(Atlet::class, 'atlet_id');
    }
}
