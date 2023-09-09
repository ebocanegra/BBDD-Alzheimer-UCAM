<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\historialesClinicos;


class HistorialesClinicosController extends Controller
{

    public function index()
    {
        $his = historialesClinicos::all();
        return response()->json($his);
    }

    public function getHistorialClinico($codigoPaciente) {
		
		if ($codigoPaciente) {
			$resultados = historialesClinicos::where('codigoPaciente', $codigoPaciente)->first();
			return $resultados; // Retorna los resultados
		} else {
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el historial clinico del paciente.'])],404);
		}

	}


    public function getHistorialClinicoCodigo($codigo) {
		
		if ($codigo) {
			$resultados = historialesClinicos::where('codigo', $codigo)->first();
			return $resultados; // Retorna los resultados
		} else {
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el historial clinico con ese codigo.'])],404);
		}

	}


    public function store(Request $request)
    {
        // Validación de campos requeridos
		$this->validate($request, [
			'codigoPaciente' => 'required',
			'tipoSangre' => 'required',
			'alcohol' => 'required',
			'fumar' => 'required',
			'actividadFisica' => 'required',
			'deterioroMemoria' => 'required',
			'dificultadConcentrarse' => 'required',
			'cambiosPersonalidad' => 'required',
			'ProblemasLenguaje' => 'required',
		]);
	
		// Crear un nuevo paciente utilizando asignación en masa
        $nuevoHistorial=historialesClinicos::create($request->all());
	
		// Construir la respuesta JSON y usar la función route() para generar la URL
		$respuesta = response()->json(['data' => $nuevoHistorial], 201)
			->header('Content-Type', 'application/json');
	
		return $respuesta;
    }




    public function update(Request $request, $codigo)
    {
        
        // Vamos a actualizar un paciente.
		// Comprobamos si el paciente existe. En otro caso devolvemos error.
		$historialClinico= historialesClinicos::find($codigo);

		// Si no existe mostramos error.
		if (! $historialClinico)
		{
			// Devolvemos error 404.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra ningun historial clínico con ese código.'])],404);
		}

        // Almacenamos en variables para facilitar el uso, los campos recibidos.
		$tipoSangre=$request->input('tipoSangre');
		$alcohol=$request->input('alcohol');
		$fumar=$request->input('fumar');
		$actividadFisica=$request->input('actividadFisica');
		$deterioroMemoria=$request->input('deterioroMemoria');
		$dificultadConcentrarse=$request->input('dificultadConcentrarse');
		$cambiosPersonalidad=$request->input('cambiosPersonalidad');
		$ProblemasLenguaje=$request->input('ProblemasLenguaje');


		// Comprobamos si recibimos petición PATCH(parcial) o PUT (Total)
		if ($request->method()=='PATCH')
		{
			$bandera=false;

			// Actualización parcial de datos.
			if ($tipoSangre !=null && $tipoSangre!='')
			{
				$historialClinico->tipoSangre=$tipoSangre;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($alcohol !=null && $alcohol!='')
			{
				$historialClinico->alcohol=$alcohol;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($fumar !=null && $fumar!='')
			{
				$historialClinico->fumar=$fumar;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($actividadFisica !=null && $actividadFisica!='')
			{
				$historialClinico->actividadFisica=$actividadFisica;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($deterioroMemoria !=null && $deterioroMemoria!='')
			{
				$historialClinico->deterioroMemoria=$deterioroMemoria;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($dificultadConcentrarse !=null && $dificultadConcentrarse!='')
			{
				$historialClinico->dificultadConcentrarse=$dificultadConcentrarse;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($cambiosPersonalidad !=null && $cambiosPersonalidad!='')
			{
				$historialClinico->cambiosPersonalidad=$cambiosPersonalidad;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($ProblemasLenguaje !=null && $ProblemasLenguaje!='')
			{
				$historialClinico->ProblemasLenguaje=$ProblemasLenguaje;
				$bandera=true;
			}

			if ($bandera)
			{
				// Grabamos el fabricante.
				$historialClinico->save();

				// Devolvemos un código 200.
				return response()->json(['status'=>'ok','data'=>$historialClinico],200);
			}
			else
			{
				// Devolvemos un código 304 Not Modified.
				return response()->json(['errors'=>array(['code'=>304,'message'=>'No se ha modificado ningún dato del historial.'])],304);
			}
		}

		// Método PUT actualizamos todos los campos.
		// Comprobamos que recibimos todos.
		if (!$tipoSangre || !$alcohol || !$fumar || !$actividadFisica || !$deterioroMemoria || !$dificultadConcentrarse || !$cambiosPersonalidad || !$ProblemasLenguaje)
		{
			// Se devuelve código 422 Unprocessable Entity.
			return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])],422);
		}

        // Actualizamos los 3 campos:
		$historialClinico->tipoSangre=$tipoSangre;
		$historialClinico->alcohol=$alcohol;
		$historialClinico->fumar=$fumar;
		$historialClinico->actividadFisica=$actividadFisica;
		$historialClinico->deterioroMemoria=$deterioroMemoria;
		$historialClinico->dificultadConcentrarse=$dificultadConcentrarse;
		$historialClinico->cambiosPersonalidad=$cambiosPersonalidad;
		$historialClinico->ProblemasLenguaje=$ProblemasLenguaje;


		// Grabamos el fabricante
		$historialClinico->save();
		return response()->json(['status'=>'ok','data'=>$historialClinico],200);

    }






}//Fin de la clase historiales clinicos
