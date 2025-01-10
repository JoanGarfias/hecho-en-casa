<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnlazadorRecuperacion
{
    public function handle(Request $request, Closure $next): Response
    {
        $rutaActual = $request->route()->getName();
        $rutaAnterior = session()->get('proceso_recuperacion');
        if($rutaActual === 'cambiar-clave.post' && $rutaAnterior !== 'recuperacion.get'){
            return redirect()->route($rutaAnterior)
            ->with('error','No tienes permiso para acceder a esta pagina');
        }
        return $next($request);
    }
}
