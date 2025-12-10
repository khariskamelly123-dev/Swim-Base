<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtletsTable extends Migration
{
    public function up()
    {
        Schema::create('atlets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klub_id')->nullable();
            $table->string('nama');
            $table->string('nisn')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('gender', ['L','P'])->nullable();
            $table->string('cabang_olahraga')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atlets');
    }
}
