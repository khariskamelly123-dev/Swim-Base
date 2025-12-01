<?php

//DATA REGIS AKUN SEKOLAH/universitaS

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Class sekouniv extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seko_univ_data', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah_universitas');
            $table->string('alamat_sekolah_universitas')->nullable();
            $table->string('kontak_seko_univ')->nullable();
            $table->string('email_resmi_seko_univ')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
        public function down(): void
        {
            Schema::dropIfExists('seko_univ_data');
        }
};