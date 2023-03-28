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
        Schema::create('session_lecturas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('posicion');
            $table->unsignedBigInteger('fk_lectura');
            $table->foreign('fk_lectura')->references('id')->on('lecturas');
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
        Schema::dropIfExists('session_lecturas');
    }
};
