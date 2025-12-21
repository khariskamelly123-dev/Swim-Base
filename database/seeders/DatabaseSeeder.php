<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\SuperAdminSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\ClubSeeder;
use Database\Seeders\InstitutionSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Core seeders
        $this->call([
            SuperAdminSeeder::class,
            AdminSeeder::class,
            ClubSeeder::class,
            InstitutionSeeder::class,
        ]);
    }
}
