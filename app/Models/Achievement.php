<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $table = 'achievements';

    protected $fillable = [
        'athlete_id',
        'club_id',
        'event_id',
        'category_id',
        'medal',
        'position',      // Rank
        'record_value',  // Result
        'fina_point',    // FP
        'date',
        'created_by',
        'notes',
    ];

    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    
    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}