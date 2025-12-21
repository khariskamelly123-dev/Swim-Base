<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Harus ini
use Illuminate\Notifications\Notifiable;

class SuperAdmin extends Authenticatable
{
    use Notifiable;
    protected $table = 'super_admins';
    // ...
}