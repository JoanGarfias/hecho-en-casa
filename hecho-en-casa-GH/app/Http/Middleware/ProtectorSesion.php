<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use App\Models\usuario;

class ProtectorSesion
{
    /*Este protector permite que solamente se pueda acceder a una ruta si el usuario tiene una sesión válida*/
    public function handle(Request $request, Closure $next) : Response
    {
        $sessionToken = $request->cookie('session_token');
        $userId = $request->cookie('user_id');

        if (!$sessionToken || !$userId) {
            return $this->redirectToLogin('Debes iniciar sesión.');
        }

        $usuario = Usuario::where('token_sesion', $sessionToken)
            ->where('id_u', $userId)
            ->first();

        if (!$usuario) {
            $this->clearSessionAndCookies();
            return $this->redirectToLogin('Sesión inválida.');
        }

        return $next($request);
    }


    /*Redirige al usuario a la página de inicio de sesión con un mensaje de error. */
    private function redirectToLogin(string $message)
    {
        return redirect()->route('login.get')->with('error', $message);
    }

    /* Elimina la sesión y las cookies del usuario. */
    private function clearSessionAndCookies()
    {
        session()->forget('id_tipopostre');

        Cookie::queue(Cookie::forget('session_token'));
        Cookie::queue(Cookie::forget('user_id'));
    }
    
}
