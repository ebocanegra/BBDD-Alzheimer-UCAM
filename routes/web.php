<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/api/pacientes', "App\Http\Controllers\PacientesController@index");
Route::get('/api/medicos', "App\Http\Controllers\MedicosController@getMedicos");
//Route::get('/api/empresas', "App\Http\Controllers\EmpresasController@getEmpresas");
Route::get('/api/historialesClinicos', "App\Http\Controllers\HistorialesClinicosController@index");



Route::get('/api/pacientes/{cifEmpresa}', "App\Http\Controllers\PacientesController@getPacientesCif");
Route::get('/api/medicos/{cifEmpresa}', "App\Http\Controllers\MedicosController@getMedicosCif");

//Ruta historial clinico
Route::get('/api/pacientes/nif/{nif}', "App\Http\Controllers\PacientesController@getPacientesNif");


//Ruta para recoger el historial clinico correspondiente al paciente seleccionado en medico-cuerpo
Route::get('/api/historialesClinicos/{codigoPaciente}', "App\Http\Controllers\HistorialesClinicosController@getHistorialClinico");
Route::get('/api/historialesClinicos/codigo/{codigo}', "App\Http\Controllers\HistorialesClinicosController@getHistorialClinicoCodigo");


Route::get('/api/pacientes/{codigo}', "App\Http\Controllers\PacientesController@show");
Route::get('/api/medicos/{codigo}', "App\Http\Controllers\MedicosController@show");

Route::get('/api/empresas/{cif}', "App\Http\Controllers\EmpresasController@getEmpresaCif");

Route::post('/api/pacientes', "App\Http\Controllers\PacientesController@store");
Route::post('/api/medicos', "App\Http\Controllers\MedicosController@store");
Route::post('/api/empresas/create', "App\Http\Controllers\EmpresasController@store");
Route::post('/api/historialesClinicos', "App\Http\Controllers\HistorialesClinicosController@store");

Route::put('/api/pacientes/{codigo}', "App\Http\Controllers\PacientesController@update");
Route::put('/api/medicos/{codigo}', "App\Http\Controllers\MedicosController@update");
Route::put('/api/empresas/{codigo}', "App\Http\Controllers\EmpresasController@update");
Route::put('/api/historialesClinicos/{codigo}', "App\Http\Controllers\HistorialesClinicosController@update");

Route::delete('/api/pacientes/{codigo}', "App\Http\Controllers\PacientesController@destroy");
Route::delete('/api/medicos/{codigo}', "App\Http\Controllers\MedicosController@destroy");
Route::delete('/api/empresas/{codigo}', "App\Http\Controllers\EmpresasController@destroy");

//Autenticacion
Route::post('/api/empresas', "App\Http\Controllers\EmpresasController@login");

//Comprobacion de codigo de seguridad del administrador
Route::get('/api/administrador/{codigo}', "App\Http\Controllers\AdministradorController@comprobarCodigo");


//Ruta para enviar emails

Route::post('/api/EnviarCorreo',"App\Http\Controllers\EmailController@index");
Route::post('/api/EnviarInforme',"App\Http\Controllers\EmailController@enviarInforme");

