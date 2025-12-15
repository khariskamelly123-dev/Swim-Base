<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atlet_id')->constrained('atlets')->cascadeOnDelete();
            $table->unsignedBigInteger('klub_id')->nullable();
            $table->foreign('klub_id')
              ->references('id')
              ->on('clubs')
              ->onDelete('set null');
            $table->foreignId('event_id')->nullable()->constrained('events')->nullOnDelete();
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->nullOnDelete();
            $table->enum('medal', ['gold','silver','bronze','none'])->default('none');
            $table->integer('posisi')->nullable();
            $table->string('record_value')->nullable();
            $table->date('tanggal')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
