<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historialesClinicos extends Model
{
    use HasFactory;

    // Nombre de la tabla en MySQL.
	protected $table="historialesClinicos";

    protected $primaryKey = 'codigo';

	// Atributos que se pueden asignar de manera masiva.
	protected $fillable = array('codigo', 'codigoPaciente', 'tipoSangre', 'alcohol', 'fumar', 'actividadFisica',  'deterioroMemoria',  'dificultadConcentrarse',  'cambiosPersonalidad', 'ProblemasLenguaje');
	

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at'];

}
