<?php

namespace App\Http\Controllers;

use App\Mail\Correo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailController extends Controller
{
    public function enviarCorreo(Request $request)
    {
        
        $correo = $request->input('correo');
        $usuario = Usuario::where('correo_electronico', $correo)->first();
        $token = $usuario->token_recuperacion;
        
        // Enviar el correo
        Mail::to($correo)->send(new Correo($token));

        $usuario->token_recuperacion = Str::random(64);
        $usuario->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Correo enviado correctamente.',
        ]);
    }

    public function mostrar()
    {
        $correo = "jeycsonlopez@gmail.com";
        return view('prueba-recuperacion', compact('correo'));
    }   
}
