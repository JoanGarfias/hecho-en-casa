<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\usuario;

class ProtectorSesion
{
    /*Este protector permite que solamente se pueda acceder a una ruta si el usuario tiene una sesión válida*/
    public function handle(Request $request, Closure $next) : Response
    {
        //Obtengo el token desde la galleta
        $sessionToken = $request->cookie('session_token');
        if (!$sessionToken) { 
            dd("No hay token de sesión");
            return redirect()->route('login.get')->with('error', 'Debes iniciar sesión.');
        }

        $usuario = usuario::where('token_sesion', $sessionToken)->first();
        if (!$usuario) {
            dd("No se encontro el usuario");
            return redirect()->route('login.get')->with('error', 'Sesión inválida.');
        }

        return $next($request);
    }
    
}
