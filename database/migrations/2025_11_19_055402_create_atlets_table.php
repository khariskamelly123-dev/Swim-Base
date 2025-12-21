<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan nama tabelnya 'athletes' (jamak, bahasa Inggris)
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birth_date');           // Dulu: tanggal_lahir / date_of_birth
            $table->string('gender');             // <--- INI YANG HILANG (Dulu: jenis_kelamin)
            $table->string('place_of_birth')->nullable(); // Dulu: tempat_lahir
            
            // Foreign Key ke tabel Clubs
            $table->foreignId('club_id')->constrained('clubs')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};