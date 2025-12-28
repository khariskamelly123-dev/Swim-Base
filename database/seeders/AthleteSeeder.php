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
        $files = [
            'diy' => database_path('seeders/csv/meet_rank_diy.csv'),
            'nasional' => database_path('seeders/csv/meet_rank_nasional.csv'),
        ];

        foreach ($files as $type => $path) {
            if (file_exists($path)) {
                $this->command->info("Memproses fail: $type...");
                $this->importFromCsv($path, $type);
            } else {
                $this->command->warn("Fail $type tidak dijumpai di: $path");
            }
        }
    }

    private function importFromCsv($path, $type)
    {
        $category = Category::firstOrCreate(
            ['slug' => 'renang-lintasan'], 
            ['name' => 'Renang Lintasan', 'description' => 'Kategori Renang Kompetisi Standar']
        );

        $admin = Admin::firstOrCreate(
            ['email' => 'admin@swimbase.com'],
            ['name' => 'Admin Operator', 'password' => Hash::make('password')]
        );

        $handle = fopen($path, "r");
        $count = 0;

        if ($type == 'diy') {
            for ($i = 0; $i < 6; $i++) fgetcsv($handle, 2000, ","); 
        } else {
            fgetcsv($handle, 2000, ","); 
        }

        DB::beginTransaction();
        try {
            while (($row = fgetcsv($handle, 2000, ",")) !== FALSE) {
                
                // 1. MAPPING DATA
                if ($type == 'diy') {
                    $rank      = $row[1] ?? null;
                    $customId  = $row[2] ?? null; 
                    $name      = $row[3] ?? null;
                    $dobRaw    = $row[5] ?? null;
                    $clubName  = $row[6] ?? 'Tanpa Kelab';
                    $city      = $row[7] ?? 'Unknown';
                    $province  = $row[8] ?? 'DI Yogyakarta';
                    $eventName = $row[9] ?? 'Unknown Event';
                    $result    = $row[10] ?? null;
                    $fp        = $row[11] ?? 0;
                } else {
                    $rank      = $row[0] ?? null;
                    $customId  = $row[1] ?? null; 
                    $name      = $row[2] ?? null;
                    $dobRaw    = $row[3] ?? null;
                    $clubName  = $row[4] ?? 'Unknown';
                    $city      = 'Unknown'; // Default untuk nasional
                    $province  = $row[4] ?? 'Indonesia';
                    $eventName = $row[5] ?? 'Database Nasional 2024';
                    $result    = $row[6] ?? null;
                    $fp        = preg_replace('/[^0-9]/', '', $row[7] ?? 0);
                }

                // 2. VALIDASI DASAR
                if (empty($name) || !is_numeric($rank)) continue;

                // 3. PARSING TANGGAL
                try {
                    $birthDate = $dobRaw ? Carbon::parse($dobRaw)->format('Y-m-d') : null;
                } catch (\Exception $e) {
                    $birthDate = null;
                }

                // 4. BUAT EVENT
                $event = Event::firstOrCreate(
                    ['slug' => Str::slug($eventName)],
                    [
                        'name' => $eventName,
                        'location' => $city,
                        'category_id' => $category->id,
                        'organizer_id' => $admin->id,
                        'status' => 'completed',
                        'start_date' => now(),
                        'end_date' => now(),
                    ]
                );

                // 5. BUAT CLUB
                $club = Club::firstOrCreate(
                    ['name' => $clubName],
                    [
                        'city' => $city,
                        'province' => $province,
                        'email' => strtolower(Str::slug($clubName)) . $count . '@swim.id',
                        'password' => Hash::make('password123'),
                        'address' => 'Imported Address',
                        'phone' => '0000',
                    ]
                );

                // 6. PERBAIKAN UTAMA: BUAT ATLET (Menghindari ID Kosong)
                $athleteSearchKey = [];
                if (!empty($customId) && is_numeric($customId)) {
                    // Jika ada NISNAS/ID, gunakan itu sebagai kunci
                    $athleteSearchKey = ['id' => $customId];
                } else {
                    // Jika ID kosong (seperti error Lovely Quinsha tadi), 
                    // cari berdasarkan Nama + Tgl Lahir agar tidak duplikat
                    $athleteSearchKey = [
                        'name' => $name, 
                        'birth_date' => $birthDate
                    ];
                }

                $athlete = Athlete::updateOrCreate(
                    $athleteSearchKey,
                    [
                        'name' => $name,
                        'birth_date' => $birthDate,
                        'club_id' => $club->id,
                        'gender' => 'Male', 
                    ]
                );

                // 7. BUAT PRESTASI
                Achievement::updateOrCreate(
                    [
                        'athlete_id' => $athlete->id,
                        'event_id'   => $event->id,
                        'position'   => $rank,
                    ],
                    [
                        'club_id'      => $club->id,
                        'record_value' => $result,
                        'fina_point'   => (int)$fp,
                        'medal'        => ($rank == 1 ? 'Gold' : ($rank == 2 ? 'Silver' : ($rank == 3 ? 'Bronze' : null))),
                        'date'         => now(),
                    ]
                );

                $count++;
            }

            DB::commit();
            fclose($handle);
            $this->command->info("Berjaya import $count data dari $type.");

        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error("Ralat pada fail $type: " . $e->getMessage());
        }
    }
}