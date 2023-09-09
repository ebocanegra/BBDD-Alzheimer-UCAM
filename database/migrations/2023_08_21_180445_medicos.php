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
        Schema::create('medicos', function (Blueprint $table) {
            $table->increments('codigo');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('nif');
            $table->string('numColegiado');
            $table->string('especialidad');
            $table->string('correo');
            $table->string('sexo');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('provincia');
            $table->string('fechaAlta');
            $table->boolean('activo');

            $table->string('cifEmpresa', 255); 
            $table->foreign('cifEmpresa')->references('cif')->on('empresas');

            // Para que también cree automáticamente los campos timestamps (created_at, updated_at)
            $table->timestamps();
        });
    }

    
    //Reverse the migrations.
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
