<?php

namespace Database\Seeders;

use App\Models\Club;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClubSeeder extends Seeder
{
    public function run(): void
    {
        // Lokasi file CSV Anda
        $files = [
            'diy' => database_path('seeders/csv/meet_rank_diy.csv'),
            'nasional' => database_path('seeders/csv/meet_rank_nasional.csv'),
        ];

        $password = Hash::make('password123');
        $this->command->info("Memulai import data Klub dari CSV...");

        foreach ($files as $type => $path) {
            if (file_exists($path)) {
                $this->importClubsFromCsv($path, $type, $password);
            } else {
                $this->command->warn("File $type tidak ditemukan di: $path. Dilewati.");
            }
        }
    }

    private function importClubsFromCsv($path, $type, $password)
    {
        $handle = fopen($path, "r");
        $rowCount = 0;
        $clubCount = 0;

        // Penanganan baris header berdasarkan jenis file
        if ($type == 'diy') {
            // File DIY memiliki baris kosong/judul di atas (sekitar 6 baris)
            for ($i = 0; $i < 6; $i++) fgetcsv($handle, 2000, ",");
        } else {
            // File Nasional biasanya hanya skip 1 baris header
            fgetcsv($handle, 2000, ",");
        }

        while (($row = fgetcsv($handle, 2000, ",")) !== FALSE) {
            // ... di dalam loop while ClubSeeder ...

$clubName = ($type == 'diy') ? ($row[6] ?? null) : ($row[4] ?? null);

// --- PERBAIKAN: Validasi Nama Klub ---
if (empty($clubName) || trim($clubName) == '' || trim($clubName) == 'Current Club / Province') {
    continue; 
}

$clubName = trim($clubName);
$slug = Str::slug($clubName);
$email = $slug . "@swimbase.com";

Club::updateOrCreate(
    ['name' => $clubName], 
    [
        'email'    => $email,
        'city'     => ($type == 'diy') ? ($row[7] ?? 'Unknown') : 'Unknown',
        'province' => ($type == 'diy') ? ($row[8] ?? 'DI Yogyakarta') : $clubName,
        'address'  => 'Imported from ' . $type,
        'phone'    => '000000',
        'password' => $password,
    ]
);
            $clubCount++;
            $rowCount++;
        }

        fclose($handle);
        $this->command->info("Selesai memproses $type: Berhasil memproses data klub.");
    }
}