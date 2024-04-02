<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class administrador extends Model
{
    use HasFactory;
    
    // Nombre de la tabla en MySQL.
	protected $table="administrador";

    protected $primaryKey = 'codigo';

	// Atributos que se pueden asignar de manera masiva.
	protected $fillable = array('codigo');

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at'];
}
