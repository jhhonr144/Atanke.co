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
        Schema::create('contenido_lecturas', function (Blueprint $table) {
            $table->id();
            $table->string('contenido',1000);
            $table->integer('posicion');
            $table->unsignedBigInteger('fk_tipo');
            $table->foreign('fk_tipo')->references('id')->on('tipo_contenidos'); 
            $table->unsignedBigInteger('fk_sesion');
            $table->foreign('fk_sesion')->references('id')->on('session_lecturas');  
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
        Schema::dropIfExists('contenido_lecturas');
    }
};
