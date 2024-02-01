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
        Schema::create('ausencias', function (Blueprint $table) {
            $table->increments('IDausencia');
            $table->string('tipo');
            $table->date('inicio');
            $table->date('fin');
            $table->integer('duracion');
            $table->string('estado');
            $table->text('motivo');
            $table->text('adjunto')->nullable();
            $table->unsignedInteger('IDempleado');
            $table->unsignedInteger('IDasistencia')->nullable();

            $table->foreign('IDempleado')->references('IDempleado')->on('empleado');
            $table->foreign('IDasistencia')->references('IDasistencia')->on('asistencias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ausencias');
    }
};
