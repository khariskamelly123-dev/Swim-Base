<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('athlete_id')->constrained('athletes')->onDelete('cascade');
            $table->foreignId('club_id')->constrained('clubs')->onDelete('cascade'); // Histori klub saat juara
            
            $table->foreignId('event_id')->nullable()->constrained('events')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');

            // Data Hasil Lomba (Mapping dari CSV)
            $table->string('medal')->nullable();         // Bisa diisi logika nanti (Juara 1=Gold, dst)
            $table->integer('position')->nullable();     // Mapping dari CSV: 'Rank'
            $table->string('record_value')->nullable();  // Mapping dari CSV: 'Result'
            $table->integer('fina_point')->nullable();   // Mapping dari CSV: 'FP' (Kolom Tambahan)
            
            $table->date('date')->nullable();            // Tanggal prestasi
            
            // Relasi ke penginput data (Admin)
            $table->foreignId('created_by')->nullable()->constrained('admins'); 
            
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};