<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\empresas;
use Illuminate\Support\Facades\DB;



class EmpresasController extends Controller
{

    public function getEmpresas(){
        return empresas::all();
    }

    public function show($codigo)
    {
        // Buscamos un medico por el codigo.
		$empresa=empresas::find($codigo);

		// Si no existe ese medico devolvemos un error.
		if (!$empresa)
		{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra la empresa con ese código.'])],404);
		}

		return response()->json(['status'=>'ok','data'=>$empresa],200);
    }
    
    public function getEmpresaCif($cif)
    {
        // Buscamos una empresa por el codigo.
        $empresa = Empresas::where('cif', $cif)->first();

		// Si no existe esa empresa devolvemos un error.
		if (!$empresa)
		{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra la empresa con ese código.'])],404);
		}

		return response()->json(['status'=>'ok','data'=>$empresa],200);
    }


    public function store(Request $request)
    {
        // Validación de campos requeridos
		$this->validate($request, [
			'nombre' => 'required',
			'cif' => 'required',
			'telefono' => 'required',
			'email' => 'required',
			'direccionWeb' => 'required',
			'codigoSeguridad' => 'required',
			'codigoPostal' => 'required',
			'direccion' => 'required',
			'provincia' => 'required',
			'ciudad' => 'required',
			'contrasena' => 'required',
			'confContrasena' => 'required',
		]);
	
		// Crear un nuevo paciente utilizando asignación en masa
        $nuevaEmpresa=empresas::create($request->all());
	
		// Construir la respuesta JSON y usar la función route() para generar la URL
		$respuesta = response()->json(['data' => $nuevaEmpresa], 201)
			->header('Content-Type', 'application/json');
	
		return $respuesta;
    }
    

    public function login(Request $request)
    {
        $cif = $request->input('cif');
        $contrasena = $request->input('contrasena');
    
        $existe = DB::table('empresas')
                    ->where('cif', $cif)
                    ->where('contrasena', $contrasena)
                    ->exists();
    
        if ($existe) {
            return response()->json(['mensaje' => 'El registro existe en la tabla.']);
        } else {
            return response()->json(['noexiste' => 'El registro no existe en la tabla.']);
        }
    }


    public function update(Request $request, $codigo)
    {
        
        // Vamos a actualizar un paciente.
		// Comprobamos si el paciente existe. En otro caso devolvemos error.
		$empresa=empresas::find($codigo);

		// Si no existe mostramos error.
		if (! $empresa)
		{
			// Devolvemos error 404.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra ninguna empresa con ese código.'])],404);
		}

		// Almacenamos en variables para facilitar el uso, los campos recibidos.
		$nombre=$request->input('nombre');
		$cif=$request->input('cif');
		$email=$request->input('email');
		$direccionWeb=$request->input('direccionWeb');
		$codigoSeguridad=$request->input('codigoSeguridad');
		$telefono=$request->input('telefono');
		$direccion=$request->input('direccion');
		$provincia=$request->input('provincia');
		$ciudad=$request->input('ciudad');
		$codigoPostal=$request->input('codigoPostal');
		$contrasena=$request->input('contrasena');
		$confContrasena=$request->input('confContrasena');


		// Comprobamos si recibimos petición PATCH(parcial) o PUT (Total)
		if ($request->method()=='PATCH')
		{
			$bandera=false;

			// Actualización parcial de datos.
			if ($nombre !=null && $nombre!='')
			{
				$empresa->nombre=$nombre;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($cif !=null && $cif!='')
			{
				$empresa->cif=$cif;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($email !=null && $email!='')
			{
				$empresa->email=$email;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($direccionWeb !=null && $direccionWeb!='')
			{
				$empresa->direccionWeb=$direccionWeb;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($codigoSeguridad !=null && $codigoSeguridad!='')
			{
				$empresa->codigoSeguridad=$codigoSeguridad;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($telefono !=null && $telefono!='')
			{
				$empresa->telefono=$telefono;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($direccion !=null && $direccion!='')
			{
				$empresa->direccion=$direccion;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($provincia !=null && $provincia!='')
			{
				$empresa->provincia=$provincia;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($ciudad !=null && $ciudad!='')
			{
				$empresa->ciudad=$ciudad;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($codigoPostal !=null && $codigoPostal!='')
			{
				$empresa->codigoPostal=$codigoPostal;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($contrasena !=null && $contrasena!='')
			{
				$empresa->contrasena=$contrasena;
				$bandera=true;
			}

			// Actualización parcial de datos.
			if ($confContrasena != null && $confContrasena != '')
			{
				$empresa->confContrasena=$confContrasena;
				$bandera=true;
			}

			if ($bandera)
			{
				// Grabamos el fabricante.
				$empresa->save();

				// Devolvemos un código 200.
				return response()->json(['status'=>'ok','data'=>$empresa],200);
			}
			else
			{
				// Devolvemos un código 304 Not Modified.
				return response()->json(['errors'=>array(['code'=>304,'message'=>'No se ha modificado ningún dato de la empresa.'])],304);
			}
		}

		// Método PUT actualizamos todos los campos.
		// Comprobamos que recibimos todos.
		if (!$nombre || !$cif || !$email || !$direccionWeb || !$codigoSeguridad || !$telefono || !$direccion || !$provincia || !$ciudad || !$codigoPostal || !$contrasena  || !$confContrasena)
		{
			// Se devuelve código 422 Unprocessable Entity.
			return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])],422);
		}

		// Actualizamos los 3 campos:
		$empresa->nombre=$nombre;
		$empresa->cif=$cif;
		$empresa->email=$email;
		$empresa->direccionWeb=$direccionWeb;
		$empresa->codigoSeguridad=$codigoSeguridad;
		$empresa->telefono=$telefono;
		$empresa->direccion=$direccion;
		$empresa->provincia=$provincia;
		$empresa->ciudad=$ciudad;
		$empresa->codigoPostal=$codigoPostal;
		$empresa->contrasena=$contrasena;
		$empresa->confContrasena=$confContrasena;


		// Grabamos la empresa
		$empresa->save();
		return response()->json(['status'=>'ok','data'=>$empresa],200);

    }//Fin de la funcion update empresa



	public function destroy($codigo)
    {
        $empresa = empresas::find($codigo);

        if (!$empresa) {
            return response()->json(['message' => 'Empresa no encontrada'], 404);
        }

        $empresa->delete();

        return response()->json(['message' => 'Empresa eliminada correctamente']);
    }




}
