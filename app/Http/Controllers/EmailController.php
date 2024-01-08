<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\EmailContacto;

class EmailController extends Controller
{
    public function index(Request $request){
        $nombre = $request->input('nombre');
        $apellidos = $request->input('apellidos');
        $correo = $request->input('correo');
        $telefono = $request->input('telefono');
        $mensaje = $request->input('mensaje');

        $contenidoCorreo = "Hola Alzheimer UCAM,\nHa contactado con usted el usuario con los siguientes datos: \n\nNombre: $nombre $apellidos. \nEmail: $correo. \nTeléfono: $telefono. \n\n El usuario ha enviado el siguiente mensaje desde la web Alzheimer UCAM:\n\n$mensaje. \n\nContacte con $nombre mediante la informacion de contacto facilitada anteriormente.";
    
        Mail::raw($contenidoCorreo, function ($message) use ($nombre) {
          $message->to('alzheimerucam@gmail.com', $nombre)
          ->subject("Email enviado desde la web Alzheimer UCAM");
        });

        return response()->json([
          'Success' => 'Excelente email enviado..',
          'code' => '200',
        ],200);
      }
      

      /*Funcion para enviar correos a otros gmails desde mi gmail,
      Falta poder enviar el informe al correo*/
      public function enviarInforme(Request $request){

        $correo = $request->input('correo');

        $contenidoCorreo = "Hola, su informe es el siguiente.";
    
        Mail::raw($contenidoCorreo, function ($message) use ($correo) {
          $message->to($correo)
          ->subject("Email enviado desde la web Alzheimer UCAM");
        });

        return response()->json([
          'Success' => 'Excelente email enviado..',
          'code' => '200',
        ],200);
      }

}
