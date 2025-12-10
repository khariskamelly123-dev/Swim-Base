<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanTable extends Migration
{
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('atlet_id')->nullable();
            $table->unsignedBigInteger('klub_id')->nullable(); // siapa pengaju
            $table->enum('tipe_pengajuan', ['edit','hapus']);
            $table->json('data_baru')->nullable(); // hanya untuk edit
            $table->text('alasan')->nullable();
            $table->enum('status', ['pending','approved','rejected'])->default('pending');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('atlet_id')->references('id')->on('atlets')->onDelete('SET NULL');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuans');
    }
}
