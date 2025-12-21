<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    use HasFactory;

    protected $table = 'athletes'; 
    
    // Matikan auto-increment jika Anda ingin ID murni dari CSV (Opsional tapi disarankan)
    // public $incrementing = false; 

    protected $fillable = [
        'id',           // <--- TAMBAHKAN INI (PENTING)
        'name',
        'birth_date',
        'gender',
        'place_of_birth',
        'club_id',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}