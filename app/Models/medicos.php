<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicos extends Model
{
    use HasFactory;

        // Nombre de la tabla en MySQL.
	protected $table="medicos";

    protected $primaryKey = 'codigo';

	// Atributos que se pueden asignar de manera masiva.
	protected $fillable = array('codigo', 'nombre', 'apellidos', 'nif', 'numColegiado', 'especialidad', 'correo',  'sexo',  'telefono', 'direccion', 'provincia', 'fechaAlta', 'activo', 'cifEmpresa');
	
	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at'];
}
