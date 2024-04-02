<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pacientes;
use App\Models\HistorialesClinicos;


class PacientesController extends Controller
{
    public function getPacientes(){
        return pacientes::all();
    }

	public function getPacientesCif($cifEmpresa) {
		
		if ($cifEmpresa) {
			$resultados = pacientes::where('cifEmpresa', $cifEmpresa)->get();
			return $resultados; // Retorna los resultados
		} else {
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentran pacientes en esta empresa.'])],404);
		}

	}

	public function getPacientesNif($nif) {
		
		if ($nif) {
			$resultados = pacientes::where('nif', $nif)->first();
			return $resultados; // Retorna los resultados
		} else {
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentran pacientes con ese nif.'])],404);
		}

	}
	

    public function store(Request $request)
    {
        // Validación de campos requeridos
		$this->validate($request, [
			'nombre' => 'required',
			'apellidos' => 'required',
			'nif' => 'required',
			'numSegSocial' => 'required',
			'correo' => 'required',
			'sexo' => 'required',
			'telefono' => 'required',
			'telefonoAuxiliar' => 'required',
			'direccion' => 'required',
			'provincia' => 'required',
			'etapaAlzheimer' => 'required',
			'fechaInscripcion' => 'required',
			'cifEmpresa' => 'required',
			'fechaNacimiento' => 'required',
			'consentimientoInformado' => 'required',
		]);
	
		// Crear un nuevo paciente utilizando asignación en masa
        $nuevoPaciente=pacientes::create($request->all());
	
		// Construir la respuesta JSON y usar la función route() para generar la URL
		$respuesta = response()->json(['data' => $nuevoPaciente], 201)
			->header('Content-Type', 'application/json');
	
		return $respuesta;
    }

    public function show($codigo)
    {
        // Buscamos un paciente por el codigo.
		$paciente=pacientes::find($codigo);

		// Si no existe ese paciente devolvemos un error.
		if (!$paciente)
		{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el paciente con ese código.'])],404);
		}

		return response()->json(['status'=>'ok','data'=>$paciente],200);
    }

	public function index()
    {
        $pac = pacientes::all();
        return response()->json($pac);
    }


	public function update(Request $request, $codigo)
    {
        
        // Vamos a actualizar un paciente.
		// Comprobamos si el paciente existe. En otro caso devolvemos error.
		$paciente=pacientes::find($codigo);

		// Si no existe mostramos error.
		if (! $paciente)
		{
			// Devolvemos error 404.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra ningun paciente con ese código.'])],404);
		}

		// Almacenamos en variables para facilitar el uso, los campos recibidos.
		$nombre=$request->input('nombre');
		$apellidos=$request->input('apellidos');
		$nif=$request->input('nif');
		$numSegSocial=$request->input('numSegSocial');
		$correo=$request->input('correo');
		$sexo=$request->input('sexo');
		$telefono=$request->input('telefono');
		$telefonoAuxiliar=$request->input('telefonoAuxiliar');
		$direccion=$request->input('direccion');
		$provincia=$request->input('provincia');
		$etapaAlzheimer=$request->input('etapaAlzheimer');
		$fechaInscripcion=$request->input('fechaInscripcion');
		$cifEmpresa=$request->input('cifEmpresa');
		$fechaNacimiento=$request->input('fechaNacimiento');
		$consentimientoInformado=$request->input('consentimientoInformado');

		// Comprobamos si recibimos petición PATCH(parcial) o PUT (Total)
		if ($request->method()=='PATCH')
		{
			$bandera=false;

			// Actualización parcial de datos.
			if ($nombre !=null && $nombre!='')
			{
				$paciente->nombre=$nombre;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($apellidos !=null && $apellidos!='')
			{
				$paciente->apellidos=$apellidos;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($nif !=null && $nif!='')
			{
				$paciente->nif=$nif;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($numSegSocial !=null && $numSegSocial!='')
			{
				$paciente->numSegSocial=$numSegSocial;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($correo !=null && $correo!='')
			{
				$paciente->correo=$correo;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($sexo !=null && $sexo!='')
			{
				$paciente->sexo=$sexo;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($telefono !=null && $telefono!='')
			{
				$paciente->telefono=$telefono;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($telefonoAuxiliar !=null && $telefonoAuxiliar!='')
			{
				$paciente->telefonoAuxiliar=$telefonoAuxiliar;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($direccion !=null && $direccion!='')
			{
				$paciente->direccion=$direccion;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($provincia !=null && $provincia!='')
			{
				$paciente->provincia=$provincia;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($etapaAlzheimer !=null && $etapaAlzheimer!='')
			{
				$paciente->etapaAlzheimer=$etapaAlzheimer;
				$bandera=true;
			}
			
			// Actualización parcial de datos.
			if ($fechaInscripcion !=null && $fechaInscripcion!='')
			{
				$paciente->fechaInscripcion=$fechaInscripcion;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($cifEmpresa !=null && $cifEmpresa!='')
			{
				$paciente->cifEmpresa=$cifEmpresa;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($fechaNacimiento !=null && $fechaNacimiento!='')
			{
				$paciente->fechaNacimiento=$fechaNacimiento;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($consentimientoInformado !=null && $consentimientoInformado!='')
			{
				$paciente->consentimientoInformado=$consentimientoInformado;
				$bandera=true;
			}

			if ($bandera)
			{
				// Grabamos el fabricante.
				$paciente->save();

				// Devolvemos un código 200.
				return response()->json(['status'=>'ok','data'=>$paciente],200);
			}
			else
			{
				// Devolvemos un código 304 Not Modified.
				return response()->json(['errors'=>array(['code'=>304,'message'=>'No se ha modificado ningún dato del correo.'])],304);
			}
		}

		// Método PUT actualizamos todos los campos.
		// Comprobamos que recibimos todos.
		if (!$nombre || !$apellidos || !$nif || !$numSegSocial || !$correo || !$sexo || !$telefono || !$telefonoAuxiliar || !$direccion  || !$provincia || !$etapaAlzheimer || !$fechaInscripcion || !$cifEmpresa || !$fechaNacimiento || !$consentimientoInformado)
		{
			// Se devuelve código 422 Unprocessable Entity.
			return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])],422);
		}

		// Actualizamos los 3 campos:
		$paciente->nombre=$nombre;
		$paciente->apellidos=$apellidos;
		$paciente->nif=$nif;
		$paciente->numSegSocial=$numSegSocial;
		$paciente->correo=$correo;
		$paciente->sexo=$sexo;
		$paciente->telefono=$telefono;
		$paciente->telefonoAuxiliar=$telefonoAuxiliar;
		$paciente->direccion=$direccion;
		$paciente->provincia=$provincia;
		$paciente->etapaAlzheimer=$etapaAlzheimer;
		$paciente->fechaInscripcion=$fechaInscripcion;
		$paciente->cifEmpresa=$cifEmpresa;
		$paciente->fechaNacimiento=$fechaNacimiento;
		$paciente->consentimientoInformado=$consentimientoInformado;

		// Grabamos el fabricante
		$paciente->save();
		return response()->json(['status'=>'ok','data'=>$paciente],200);

    }


	public function destroy($codigo)
	{
		// Buscar el paciente por su código
		$paciente = Pacientes::find($codigo);

		// Verificar si el paciente existe
		if (!$paciente) {
			return response()->json(['message' => 'Paciente no encontrado'], 404);
		}

		try {
			// Obtener y eliminar el historial clínico asociado al paciente
			$historialClinico = HistorialesClinicos::where('codigoPaciente', $codigo)->first();
			if ($historialClinico) {
				$historialClinico->delete();
			}

			// Eliminar el paciente
			$paciente->delete();

			// Responder con éxito
			return response()->json(['message' => 'Paciente y su historial clínico eliminados correctamente']);
		} catch (\Exception $e) {
			// Deshacer la transacción en caso de error
			\DB::rollBack();

			// Responder con un mensaje de error
			return response()->json(['message' => 'Error al eliminar el paciente y su historial clínico'], 500);
		}
	}


}
