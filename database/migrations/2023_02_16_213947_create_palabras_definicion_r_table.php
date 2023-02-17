<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palabras_definicion_r', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger ('fk_palabra');
            $table->foreign('fk_palabra')->references('id')->on('palabras');
            $table->unsignedBigInteger('fk_definicion');
            $table->foreign('fk_definicion')->references('id')->on('definiciones');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('palabras__definicion_rs');
    }
};
