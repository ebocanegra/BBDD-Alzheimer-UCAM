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
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('codigo');
            $table->string('nombre');
            $table->string('cif', 255)->unique();
            $table->string('telefono');
            $table->string('email');
            $table->string('direccionWeb');
            $table->string('codigoSeguridad');
            $table->string('codigoPostal');
            $table->string('direccion');
            $table->string('provincia');
            $table->string('ciudad');
            $table->string('contrasena');
            $table->string('confContrasena');
            $table->string('contrasenaCambiada');

            // Para que también cree automáticamente los campos timestamps (created_at, updated_at)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
