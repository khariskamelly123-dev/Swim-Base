<?php

namespace Database\Seeders;

use App\Models\sekouniv;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SekounivSeeder extends Seeder
{
    public function run(): void
    {
        sekouniv::updateOrCreate(
            ['email_resmi_seko_univ' => 'school1@example.com'],
            [
                'nama_sekolah_universitas' => 'Contoh Sekolah 1',
                'alamat_sekolah_universitas' => 'Jl. Sekolah No.1',
                'kontak_seko_univ' => '081234567891',
                'email_resmi_seko_univ' => 'school1@example.com',
                'password' => Hash::make('password'),
            ]
        );
    }
}
