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
        Schema::create('palabras_multimedia_r', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger ('fk_palabra');
            $table->foreign('fk_palabra')->references('id')->on('palabras');
            $table->unsignedBigInteger('fk_multimedia');
            $table->foreign('fk_multimedia')->references('id')->on('multimedias');
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
        Schema::dropIfExists('palabras__multimedia_r');
    }
};
