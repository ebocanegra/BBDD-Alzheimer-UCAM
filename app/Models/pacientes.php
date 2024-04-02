<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pacientes extends Model
{
    use HasFactory;

    // Nombre de la tabla en MySQL.
	protected $table="pacientes";

    protected $primaryKey = 'codigo';

	// Atributos que se pueden asignar de manera masiva.
	protected $fillable = array('codigo', 'nombre', 'apellidos', 'nif', 'numSegSocial', 'correo',  'sexo',  'telefono',  'telefonoAuxiliar', 'direccion', 'provincia', 'etapaAlzheimer', 'fechaInscripcion', 'cifEmpresa', 'fechaNacimiento', 'consentimientoInformado');
	

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at'];
}
