<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel athletes (bisa null jika ini pengajuan atlet baru yang belum punya ID)
            $table->foreignId('athlete_id')->nullable()->constrained('athletes')->onDelete('cascade');
            
            // Relasi ke tabel clubs
            $table->foreignId('club_id')->constrained('clubs')->onDelete('cascade');
            
            $table->string('submission_type'); // Contoh: 'create', 'update', 'transfer'
            
            // Kolom JSON untuk menyimpan data perubahan
            $table->json('new_data')->nullable(); 
            
            $table->text('reason')->nullable();
            
            // Status default biasanya 'pending' (menunggu)
            $table->string('status')->default('pending'); 
            
            // Relasi ke user (admin) yang melakukan approve
            $table->foreignId('approved_by')->nullable()->constrained('users');
            
            $table->text('notes')->nullable(); // Catatan penolakan/persetujuan
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};