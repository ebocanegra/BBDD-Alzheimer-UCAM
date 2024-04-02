<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\administrador;

class AdministradorController extends Controller
{
    public function comprobarCodigo($codigo) {

        $existe=administrador::find($codigo);
    
        if ($existe) {
            return response()->json(['mensaje' => true]);
        } else {
            return response()->json(['mensaje' => false]);
        }

	}
}
