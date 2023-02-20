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
        Schema::create('roles_permisos_r', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger ('fk_permiso');
            $table->foreign('fk_permiso')->references('id')->on('permisos');
            $table->unsignedBigInteger('fk_rol');
            $table->foreign('fk_rol')->references('id')->on('roles');
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
        Schema::dropIfExists('roles_permisos_r');
    }
};
