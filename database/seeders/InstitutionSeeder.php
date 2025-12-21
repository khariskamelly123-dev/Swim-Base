<?php

namespace Database\Seeders;

use App\Models\Institution;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InstitutionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Contoh Data Sekolah (SMA)
        Institution::updateOrCreate(
            ['email' => 'sman1.wsb@sch.id'],
            [
                'name'     => 'SMA Negeri 1 Wonosobo',
                'type'     => 'school',
                'address'  => 'Jl. T. Jogonegoro No. 8',
                'phone'    => '0286123456',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Contoh Data Universitas (UNSIQ)
        Institution::updateOrCreate(
            ['email' => 'unsiq@ac.id'],
            [
                'name'     => 'UNSIQ Wonosobo',
                'type'     => 'university',
                'address'  => 'Jl. Kalibeber Km. 3, Wonosobo',
                'phone'    => '0286654321',
                'password' => Hash::make('password123'),
            ]
        );
    }
}