<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Enlazador
{
    public function handle(Request $request, Closure $next)
    {
        $flujo = $this->obtenerFlujo();


        //VALIDAR QUE NO SEA NULL
        $estadoActual = session('estado_flujo');
        // Validar si la ruta actual corresponde al estado actual
        $rutaActual = $request->route()->getName();

        //dd($rutaActual);

        //dd($estadoActual, $flujo, $rutaActual);
        $rutaActual = trim($request->route()->getName());
        

        //ESTO SE TIENE QUE VALIDAR QUE NO SEA NULL
        $permitidas = array_map('trim', $flujo[$estadoActual]['permitidas']);

        //dd(gettype($rutaActual), $rutaActual, array_map('gettype', $permitidas), $permitidas);

        foreach ($permitidas as $permitida) {
            if ($rutaActual === $permitida) {
                dd('Match found', $rutaActual, $permitida);
            }
        }        

        // Si la ruta actual corresponde a una etapa válida, actualizar el estado
        session(['estado_flujo' => $flujo[$estadoActual]['siguiente']]);

        return $next($request);
    }

    private function obtenerFlujo()
    {
        return [
            // Flujo para fijo
            'fijo.catalogo.get' => [
                'permitidas' => ['fijo.catalogo.get', 'inicio'],
                'siguiente' => 'fijo.calendario.post',
            ],
            'fijo.catalogo.post' => [
                'permitidas' => ['fijo.catalogo.get'],
                'siguiente' => 'fijo.calendario.get',
            ],
            'fijo.calendario.get' => [
                'permitidas' => ['fijo.calendario.get'],
                'siguiente' => 'fijo.calendario.post',
            ],
            'fijo.calendario.post' => [
                'permitidas' => ['fijo.calendario.post'],
                'siguiente' => 'fijo.detallesPedido.get',
            ],
            'fijo.detallesPedido.get' => [
                'permitidas' => ['fijo.detallesPedido.get'],
                'siguiente' => 'fijo.ticket.get',
            ],
            'fijo.ticket.get' => [
                'permitidas' => ['fijo.ticket.get'],
                'siguiente' => null, // Fin del flujo
            ],
        ];
    }   
}
