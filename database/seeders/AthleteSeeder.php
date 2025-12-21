<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Athlete;
use App\Models\Club;
use App\Models\Event;
use App\Models\Achievement;
use App\Models\Category;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AthleteSeeder extends Seeder
{
    public function run(): void
    {
        $csvFile = database_path('seeders/csv/meet_rank.csv');

        if (file_exists($csvFile)) {
            $this->importFromCsv($csvFile);
        } else {
            $this->command->warn("File CSV tidak ditemukan.");
        }
    }

    private function importFromCsv($path)
    {
        $this->command->info("Memulai import data atlet...");
        
        // --- LANGKAH 1: AUTO-FIX DEPENDENSI ---
        
        // 1. Buat Kategori 'Swimming'
        $category = Category::firstOrCreate(
            ['name' => 'Renang Lintasan'], 
            [
                'slug'        => 'renang-lintasan',
                'description' => 'Kategori Renang Kompetisi Standar'
            ]
        );

        // 2. Buat Admin Default (PERBAIKAN: Hapus 'phone')
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@swimbase.com'],
            [
                'name'     => 'Admin Operator',
                'password' => Hash::make('password'),
                // 'phone'    => '08123456789' // Baris ini dihapus karena kolom phone tidak ada di tabel admins
            ]
        );

        $handle = fopen($path, "r");
        $delimiter = ","; 

        // Skip header row
        fgetcsv($handle, 2000, $delimiter); 

        $count = 0;
        
        DB::beginTransaction();
        try {
            while (($row = fgetcsv($handle, 2000, $delimiter)) !== FALSE) {
                
                // Validasi Header/Sampah
                if (!isset($row[0]) || !is_numeric($row[0])) {
                    continue;
                }

                // --- MAPPING (SESUAI CSV ANDA) ---
                $rank      = $row[0] ?? null; 
                $customId  = $row[1] ?? null;
                $name      = $row[2] ?? null;
                // $row[3] kosong
                $dobRaw    = $row[4] ?? null;
                $clubName  = $row[5] ?? null;
                $city      = $row[6] ?? null;
                $province  = $row[7] ?? 'DI Yogyakarta';
                $eventName = $row[8] ?? 'UNKNOWN EVENT';
                $result    = $row[9] ?? null;
                $fp        = $row[10] ?? 0;

                if (empty($name)) continue;

                // Format Tanggal
                try {
                    $birthDate = Carbon::parse($dobRaw)->format('Y-m-d');
                } catch (\Exception $e) {
                    $birthDate = null; 
                }

                // --- BUAT EVENT ---
                $eventSlug = Str::slug($eventName);
                $event = Event::firstOrCreate(
                    ['slug' => $eventSlug],
                    [
                        'name'         => $eventName,
                        'location'     => 'Yogyakarta',
                        'start_date'   => now(),
                        'end_date'     => now(),
                        'category_id'  => $category->id, 
                        'organizer_id' => $admin->id,    
                        'status'       => 'completed'
                    ]
                );

                // --- BUAT CLUB ---
                $cleanClubName = preg_replace('/[^a-zA-Z0-9]/', '', $clubName);
                if(empty($clubName)) $clubName = "Unknown Club"; 

                $club = Club::firstOrCreate(
                    ['name' => $clubName], 
                    [
                        'city'     => $city ?? 'Unknown', 
                        'province' => $province,
                        'email'    => strtolower($cleanClubName) . $count . '@dummy.com',
                        'address'  => 'Alamat import',
                        'phone'    => '000000',
                        'password' => Hash::make('password123') 
                    ]
                );

                // --- BUAT ATLET ---
                Athlete::updateOrCreate(
                    ['id' => $customId],
                    [
                        'name'           => $name, 
                        'birth_date'     => $birthDate,
                        'gender'         => 'Male', 
                        'place_of_birth' => $city,
                        'club_id'        => $club->id,
                    ]
                );

                // --- BUAT PRESTASI ---
                Achievement::updateOrCreate(
                    [
                        'athlete_id' => $customId,
                        'event_id'   => $event->id,
                        'position'   => $rank,
                    ],
                    [
                        'club_id'      => $club->id,
                        'record_value' => $result,
                        'fina_point'   => $fp,
                        'date'         => now(),
                        'medal'        => ($rank == 1 ? 'Gold' : ($rank == 2 ? 'Silver' : ($rank == 3 ? 'Bronze' : null))),
                    ]
                );

                $count++;
            }
            
            DB::commit();
            fclose($handle);
            $this->command->info("SUKSES: $count atlet & prestasi berhasil diimport!");

        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error("Gagal: " . $e->getMessage());
        }
    }
}