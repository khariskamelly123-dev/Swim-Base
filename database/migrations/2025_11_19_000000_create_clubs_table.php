<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clubs', function (Blueprint $table) {
        $table->id();
        $table->string('nama_klub');
        $table->string('provinsi')->nullable();
        $table->string('kota')->nullable();
        $table->text('alamat_klub')->nullable();
        $table->string('kontak_club')->nullable();
        $table->string('email_resmi')->unique();
        $table->string('password');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
