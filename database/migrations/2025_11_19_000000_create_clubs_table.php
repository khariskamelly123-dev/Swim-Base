<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // Nama Klub
            $table->string('province');         // Provinsi
            $table->string('city');             // Kota
            $table->text('address');            // Alamat (pakai text agar muat panjang)
            $table->string('phone');            // Kontak/No HP
            $table->string('email')->unique();  // Email Resmi (Wajib Unique untuk login)
            $table->string('password');         // Password
            $table->rememberToken();            // Untuk fitur "Remember Me"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};