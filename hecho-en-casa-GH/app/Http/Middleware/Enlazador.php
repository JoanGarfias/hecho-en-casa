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
            return redirect()->route('fijo.catalogo.get');
        }

        session()->put('ultima_etapa', $rutaActual);
        return $next($request);
    }

    private function obtenerFlujo(Request $request)
    {

        // Obtener la opción seleccionada por el usuario
        $opcionEnvio = session()->get('opcion_envio', null);

        if ($request->is('fijo/*')) {
            $rutaBase = [
                //'fijo.catalogo.get',
                'fijo.catalogo.get',
                'fijo.catalogo.post',
                'calendario.get',
                'calendario.post',
                'fijo.detallesPedido.get',
                'fijo.detallesPedido.post'
            ];
            if($opcionEnvio === "Domicilio"){
                return array_merge($rutaBase, [
                    'fijo.direccion.get',
                    'fijo.direccion.post',
                    'fijo.ticket.get',
                ]);
            }
            else{
                return array_merge($rutaBase, [
                    'fijo.ticket.get',
                ]);
            }
        }

        if ($request->is('personalizado/*')) {
            $rutaBase = [
                'personalizado.catalogo.get',
                'personalizado.catalogo.post',
                'personalizado.calendario.get',
                'personalizado.calendario.post',
                'personalizado.detallesPedido.get',
                'personalizado.detallesPedido.post'
            ];
            if($opcionEnvio === "Domicilio"){
                return array_merge($rutaBase, [
                    'personalizado.direccion.get',
                    'personalizado.direccion.post',
                    'personalizado.ticket.get',
                ]);
            }
            else{
                return array_merge($rutaBase, [
                    'personalizado.ticket.get',
                ]);
            }
        }

        if ($request->is('emergentes/*')) {
            $rutaBase = [
                'emergente.catalogo.get',
                'emergente.catalogo.post',
                'emergente.calendario.get',
                'emergente.calendario.post',
                'emergente.detallesPedido.get',
                'emergente.detallesPedido.post'
            ];
            if($opcionEnvio === "Domicilio"){
                return array_merge($rutaBase, [
                    'emergente.direccion.get',
                    'emergente.direccion.post',
                    'emergente.ticket.get',
                ]);
            }
            else{
                return array_merge($rutaBase, [
                    'emergente.ticket.get',
                ]);
            }
        }

        return null;
    }
}
