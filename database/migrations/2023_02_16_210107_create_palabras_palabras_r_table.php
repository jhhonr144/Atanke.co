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
        Schema::create('palabras_palabras_r', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('palabra_id_1');
            $table->foreign('palabra_id_1')->references('id')->on('palabras');
            $table->unsignedBigInteger('palabra_id_2');
            $table->foreign('palabra_id_2')->references('id')->on('palabras');
            $table->enum('relacion',['Traducion','Sinonimo','Antonimo'])->default('Traducion');
            $table->unsignedBigInteger('fk_user');
            $table->foreign('fk_user')->references('id')->on('users');
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
        Schema::dropIfExists('palabras_palabras_rs');
    }
};
