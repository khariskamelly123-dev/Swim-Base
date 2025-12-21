<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        SuperAdmin::create([
            'name'     => 'Master Admin',
            'email'    => 'super@admin.com',
            'password' => Hash::make('password123'), // Ganti password yang aman
        ]);
    }
}