<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departamento', function (Blueprint $table) {
            $table->increments('IDdepartamento');
            $table->string('nombreDep');
            $table->timestamps();
        });

        /**DB::table('departamento')->insert([
            ['nombreDep' => 'Plant Manager'],
            ['nombreDep' => 'Jefatura'],
            ['nombreDep' => 'Proyect Manager'],
            ['nombreDep' => 'Recursos Humanos'],
            ['nombreDep' => 'Marketing'],
            ['nombreDep' => 'Ventas'],
            ['nombreDep' => 'TI'],
            ['nombreDep' => 'Finanzas'],
            ['nombreDep' => 'Contabilidad'],
            ['nombreDep' => 'Calidad'],
            ['nombreDep' => 'Legal'],
            ['nombreDep' => 'Logistica'],
            ['nombreDep' => 'Diseño grafico'],
            ['nombreDep' => 'Customer service'],
            ['nombreDep' => 'Psicologia'],
            ['nombreDep' => 'Nutricion'],
        ]);
        */
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamento');
    }
};
