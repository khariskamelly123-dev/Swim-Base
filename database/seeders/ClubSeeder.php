<?php

namespace Database\Seeders;

use App\Models\Club;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClubSeeder extends Seeder
{
    public function run(): void
    {
        Club::updateOrCreate(
            ['email_resmi' => 'club1@example.com'],
            [
                'nama_klub' => 'Contoh Klub 1',
                'alamat_klub' => 'Jl. Contoh No.1',
                'kontak_club' => '081234567890',
                'email_resmi' => 'club1@example.com',
                'pelatih' => 'Pelatih Contoh',
                'password' => Hash::make('password'),
            ]
        );
    }
}
