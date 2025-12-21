<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ... bagian atas sama
    Schema::create('events', function (Blueprint $table) {
    $table->id();
    $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
    
    $table->string('name');
    $table->string('slug')->unique();
    $table->string('location');
    $table->dateTime('start_date');
    $table->dateTime('end_date');
    
    // PERBAIKAN DI SINI:
    // Mengarah ke tabel 'users' (karena admin adalah user)
    $table->foreignId('organizer_id')->constrained('admins')->onDelete('cascade');
    
    $table->string('status')->default('upcoming');
    $table->text('description')->nullable();
    $table->timestamps();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};