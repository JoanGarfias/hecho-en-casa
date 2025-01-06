<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Enlazador
{
    public function handle(Request $request, Closure $next)
    {
        $flujo = $this->obtenerFlujo($request);

        if (!$flujo) {
            return redirect()->route('fijo.catalogo.get');
        }
        $rutaActual = $request->route()->getName();
        $ultimaEtapaCompletada = session()->get('ultima_etapa', null);

        if (!in_array($rutaActual, $flujo)) {
            return redirect()->route('fijo.catalogo.get');
        }

        $indiceRutaActual = array_search($rutaActual, $flujo);
        $indiceUltimaEtapa = $ultimaEtapaCompletada ? array_search($ultimaEtapaCompletada, $flujo) : -1;

        if ($indiceRutaActual === false || $indiceRutaActual > $indiceUltimaEtapa + 1) {
            return redirect()->route('catalogo.get');
        }

        session()->put('ultima_etapa', $rutaActual);

        return $next($request);
    }

    private function obtenerFlujo(Request $request)
    {
        if ($request->is('fijo/*')) {
            return [
                //'fijo.catalogo.get',
                'calendario.get',
                'fijo.detallesPedido.get',
                'fijo.direccion.get',
                'fijo.ticket.get',
            ];
        }

        if ($request->is('personalizado/*')) {
            return [
                //'personalizado.catalogo.get',
                'personalizado.detallesPedido.get',
                'personalizado.direccion.get',
                'personalizado.ticket.get',
            ];
        }

        if ($request->is('emergentes/*')) {
            return [
                'emergente.catalogo.get',
                'emergente.detallesPedido.get',
                'emergente.direccion.get',
                'emergente.ticket.get',
            ];
        }

        return null;
    }
}
