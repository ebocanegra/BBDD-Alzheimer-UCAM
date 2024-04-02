<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class empresas extends Authenticatable
{
    use HasFactory;
    
    // Nombre de la tabla en MySQL.
	protected $table="empresas";

    protected $primaryKey = 'codigo';

	// Atributos que se pueden asignar de manera masiva.
	protected $fillable = array('codigo', 'nombre', 'cif', 'telefono', 'email', 'direccionWeb', 'codigoSeguridad', 'codigoPostal', 'direccion', 'provincia', 'ciudad', 'contrasena', 'confContrasena', 'contrasenaCambiada');
	

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at'];
}

