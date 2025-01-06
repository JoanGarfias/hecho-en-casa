<?php

namespace App\Http\Controllers;

use App\Mail\Correo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function enviarCorreo(Request $request)
    {
        // Detalles del correo
        $detalles = [
            'nombre' => 'Juan Pérez',
            'mensaje' => 'Este es un correo de prueba desde Laravel.',
        ];

        // Enviar el correo
        Mail::to('jeycsonlopez@gmail.com')->send(new Correo($detalles));

        return response()->json([
            'success' => true,
            'message' => 'Correo enviado correctamente.',
        ]);
    }

    public function mostrar(Request $request)
    {
        $correo = $request->query('email');
        return view('prueba-recuperacion', compact('correo'));
    }   
}
