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
        Schema::create('historialesClinicos', function (Blueprint $table) {
            $table->increments('codigo');

            $table->unsignedInteger('codigoPaciente');
            $table->foreign('codigoPaciente')->references('codigo')->on('pacientes');

            $table->string('tipoSangre');
            $table->string('alcohol');
            $table->string('fumar');
            $table->string('actividadFisica');
            $table->string('deterioroMemoria');
            $table->string('dificultadConcentrarse');
            $table->string('cambiosPersonalidad');
            $table->string('ProblemasLenguaje');

            // Para que también cree automáticamente los campos timestamps (created_at, updated_at)
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('historialesClinicos');
        
    }
};
