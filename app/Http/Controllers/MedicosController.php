<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\medicos;




class MedicosController extends Controller
{
    public function getMedicos(){
        return medicos::all();
    }

	public function getMedicosCif($cifEmpresa) {
		
		if ($cifEmpresa) {
			$resultados = medicos::where('cifEmpresa', $cifEmpresa)->get();
			return $resultados; // Retorna los resultados
		} else {
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentran medicos en esta empresa.'])],404);
		}

	}

	
    public function store(Request $request)
    {
        // Validación de campos requeridos
		$this->validate($request, [
			'nombre' => 'required',
			'apellidos' => 'required',
			'nif' => 'required',
            'numColegiado' => 'required',
			'especialidad' => 'required',
			'correo' => 'required',
			'sexo' => 'required',
			'telefono' => 'required',
			'direccion' => 'required',
			'provincia' => 'required',
			'fechaAlta' => 'required',
			'activo' => 'required',
			'cifEmpresa' => 'required',
		]);
	
		// Crear un nuevo paciente utilizando asignación en masa
        $nuevoMedico=medicos::create($request->all());
	
		// Construir la respuesta JSON y usar la función route() para generar la URL
		$respuesta = response()->json(['data' => $nuevoMedico], 201)
			->header('Content-Type', 'application/json');
	
		return $respuesta;
    }

    

    public function show($codigo)
    {
        // Buscamos un medico por el codigo.
		$medico=medicos::find($codigo);

		// Si no existe ese medico devolvemos un error.
		if (!$medico)
		{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el medico con ese código.'])],404);
		}

		return response()->json(['status'=>'ok','data'=>$medico],200);
    }


	public function update(Request $request, $codigo)
    {
        
        // Vamos a actualizar un paciente.
		// Comprobamos si el paciente existe. En otro caso devolvemos error.
		$medico=medicos::find($codigo);

		// Si no existe mostramos error.
		if (! $medico)
		{
			// Devolvemos error 404.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra ningun paciente con ese código.'])],404);
		}

		// Almacenamos en variables para facilitar el uso, los campos recibidos.
		$nombre=$request->input('nombre');
		$apellidos=$request->input('apellidos');
		$nif=$request->input('nif');
		$numColegiado=$request->input('numColegiado');
		$especialidad=$request->input('especialidad');
		$correo=$request->input('correo');
		$sexo=$request->input('sexo');
		$telefono=$request->input('telefono');
		$direccion=$request->input('direccion');
		$provincia=$request->input('provincia');
		$fechaAlta=$request->input('fechaAlta');
		$activo=$request->input('activo');
		$cifEmpresa=$request->input('cifEmpresa');

		// Comprobamos si recibimos petición PATCH(parcial) o PUT (Total)
		if ($request->method()=='PATCH')
		{
			$bandera=false;

			// Actualización parcial de datos.
			if ($nombre !=null && $nombre!='')
			{
				$medico->nombre=$nombre;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($apellidos !=null && $apellidos!='')
			{
				$medico->apellidos=$apellidos;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($nif !=null && $nif!='')
			{
				$medico->nif=$nif;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($numColegiado !=null && $numColegiado!='')
			{
				$medico->numColegiado=$numColegiado;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($especialidad !=null && $especialidad!='')
			{
				$medico->especialidad=$especialidad;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($correo !=null && $correo!='')
			{
				$medico->correo=$correo;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($sexo !=null && $sexo!='')
			{
				$medico->sexo=$sexo;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($telefono !=null && $telefono!='')
			{
				$medico->telefono=$telefono;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($direccion !=null && $direccion!='')
			{
				$medico->direccion=$direccion;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($provincia !=null && $provincia!='')
			{
				$medico->provincia=$provincia;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($fechaAlta !=null && $fechaAlta!='')
			{
				$medico->fechaAlta=$fechaAlta;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($activo !=null && $activo!='')
			{
				$medico->activo=$activo;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($cifEmpresa !=null && $cifEmpresa!='')
			{
				$medico->cifEmpresa=$cifEmpresa;
				$bandera=true;
			}

			if ($bandera)
			{
				// Grabamos el fabricante.
				$medico->save();

				// Devolvemos un código 200.
				return response()->json(['status'=>'ok','data'=>$medico],200);
			}
			else
			{
				// Devolvemos un código 304 Not Modified.
				return response()->json(['errors'=>array(['code'=>304,'message'=>'No se ha modificado ningún dato del correo.'])],304);
			}
		}

		// Método PUT actualizamos todos los campos.
		// Comprobamos que recibimos todos.
		if (!$nombre || !$apellidos || !$nif || !$numColegiado || !$especialidad || !$correo || !$sexo || !$telefono || !$direccion  || !$provincia || !$fechaAlta || !$activo || !$cifEmpresa)
		{
			// Se devuelve código 422 Unprocessable Entity.
			return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])],422);
		}

		// Actualizamos los 3 campos:
		$medico->nombre=$nombre;
		$medico->apellidos=$apellidos;
		$medico->nif=$nif;
		$medico->numColegiado=$numColegiado;
		$medico->especialidad=$especialidad;
		$medico->correo=$correo;
		$medico->sexo=$sexo;
		$medico->telefono=$telefono;
		$medico->direccion=$direccion;
		$medico->provincia=$provincia;
		$medico->fechaAlta=$fechaAlta;
		$medico->activo=$activo;
		$medico->cifEmpresa=$cifEmpresa;

		// Grabamos el fabricante
		$medico->save();
		return response()->json(['status'=>'ok','data'=>$medico],200);

    }


    public function destroy($codigo)
    {
        $medico = medicos::find($codigo);

        if (!$medico) {
            return response()->json(['message' => 'Médico no encontrado'], 404);
        }

        $medico->delete();

        return response()->json(['message' => 'Médico eliminado correctamente']);
    }

}
