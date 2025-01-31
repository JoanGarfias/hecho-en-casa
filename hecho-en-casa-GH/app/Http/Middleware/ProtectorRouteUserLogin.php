<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\usuario;

class ProtectorRouteUserLogin
{
    public function handle(Request $request, Closure $next)
    {
        $sessionToken = $request->cookie('session_token');
        $usuario = usuario::select('id_u')->where('token_sesion', $sessionToken)->first();


        if ($sessionToken && $usuario) { 
            if(request()->routeIs('login.get') || request()->routeIs('login.post') || request()->routeIs('registrar.get') || request()->routeIs('registrar.post')){
                return redirect()->back()->withErrors('error', 'No estás permitido entrar porque ya estás logueado.');
            }
        }

        return $next($request);
    }
}
