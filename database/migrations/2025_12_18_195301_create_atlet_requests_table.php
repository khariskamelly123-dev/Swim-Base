<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_atlet_requests_table.php
public function up()
{
    Schema::create('atlet_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('club_id'); // Klub yang mengajukan
        $table->foreignId('atlet_id'); // Atlet yang mau diubah/hapus
        $table->enum('jenis_pengajuan', ['update', 'delete']);
        $table->text('data_baru')->nullable(); // Simpan data edit dalam format JSON
        $table->text('alasan')->nullable(); // Kenapa mau dihapus/diedit?
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atlet_requests');
    }
};
