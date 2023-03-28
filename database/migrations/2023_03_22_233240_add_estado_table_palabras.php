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
        Schema::table('palabras', function (Blueprint $table) { 
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])
            ->nullable(false)
            ->default('pendiente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('palabras', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
