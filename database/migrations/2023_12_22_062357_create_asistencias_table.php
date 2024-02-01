<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->increments('IDasistencia');
            $table->date('fecha');
            $table->time('entrada')->nullable();
            $table->time('salida')->nullable();
            $table->unsignedSmallInteger('semana');
            $table->string('dia', 10);
            $table->string('validar', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};