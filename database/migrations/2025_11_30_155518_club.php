<?php

// DATA REGIS AKUN CLUB

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Class Club extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('club_data', function (Blueprint $table) {
            $table->id();
            $table->string('nama_klub');
            $table->string('alamat_klub')->nullable();
            $table->string('kontak_club')->nullable();
            $table->string('email_resmi')->unique();
            $table->string('pelatih')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club_data');
    }
};
