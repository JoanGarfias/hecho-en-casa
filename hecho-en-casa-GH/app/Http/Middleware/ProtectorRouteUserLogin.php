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
        //$rutaActual = $request->route()->getName();
        $sessionToken = $request->cookie('session_token');
        $usuario = usuario::where('token_sesion', $sessionToken)->first();

        if ($sessionToken && $usuario) { 
            if (request()->routeIs('cerrarsesion.get')){
                $usuario->update(['token_sesion' => null]);
                return redirect()->route('inicio.get')->with('info', 'Sesión cerrada exitosamente.');
            }
            //dd("No estas permitido entrar por que ya estas logueado");
            if(request()->routeIs('login.get') || request()->routeIs('login.post') || request()->routeIs('registrar.get') || request()->routeIs('registrar.post')){
                //return redirect()->route('inicio.get')->with('error', 'No estas permitido entrar por que ya estas logueado');
                return redirect()->back()->with('error', 'No estás permitido entrar porque ya estás logueado.');
            }
        }
        //dd("No estas logueado");
        return $next($request);
    }
}
