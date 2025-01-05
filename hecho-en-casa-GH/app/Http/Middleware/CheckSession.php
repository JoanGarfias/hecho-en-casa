<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\usuario;

class CheckSession
{
    public function handle(Request $request, Closure $next): Response
    {
        //Obtengo el token desde la galleta
        $sessionToken = $request->cookie('session_token');
    
        if (!$sessionToken) { //No hay token, mandar al inicio
            return redirect('/login')->with('error', 'Debes iniciar sesión.');
        }

        $usuario = usuario::where('token_sesion', $sessionToken)->first();
    
        if (!$usuario) {
            return redirect('/login')->with('error', 'Sesión inválida.');
        }
    
        return $next($request);
    }
    
}
