<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Nama tabel disesuaikan dengan ejaan bahasa Inggris yang benar
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];
    
    // OPSI: Jika kategori ini nanti punya relasi (misal ke Event atau Berita)
    // kamu bisa tambahkan function relasinya di sini nanti.
}