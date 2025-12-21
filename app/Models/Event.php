<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'slug',
        'name',
        'location',
        'start_date',
        'end_date',
        'category_id',
        'organizer_id',
        'status',
        'description', // tambahkan jika ada di migrasi
        'banner',      // tambahkan jika ada
    ];

    // --- TAMBAHKAN BAGIAN INI ---
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];
    // ----------------------------

    // Relasi (yang sudah ada sebelumnya)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function organizer()
    {
        // Sesuaikan dengan model Admin Anda
        return $this->belongsTo(Admin::class, 'organizer_id');
    }
}