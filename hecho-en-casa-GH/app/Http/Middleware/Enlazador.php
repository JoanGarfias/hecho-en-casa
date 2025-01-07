<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isEmpty;

class Enlazador
{
    public function handle(Request $request, Closure $next)
    {


        //VALIDAR QUE NO SEA NULL
        $estadoActual = session('estado_flujo');
        //dd($estadoActual);

        if($estadoActual === null){
            return redirect()->route('inicio.get');
        }

        $flujo = $this->obtenerFlujo($estadoActual);

        // Validar si la ruta actual corresponde al estado actual
        
        $rutaActual = $request->route()->getName();
        //dd("Ruta actual: ".$rutaActual, $flujo[$rutaActual]['permitidas']);


        //ESTO SE TIENE QUE VALIDAR QUE NO SEA NULL
        $permitidas = array_map('trim', $flujo[$rutaActual]['permitidas']);

        foreach ($permitidas as $permitida) {
            if ($rutaActual !== $permitida) {
                //dd('Match found', $rutaActual, $permitida);
            }
        }        

        // Si la ruta actual corresponde a una etapa válida, actualizar el estado
        //session(['estado_flujo' => $flujo[$rutaActual]['siguiente']]);

        return $next($request);
    }

    private function obtenerFlujo($estado)
    {
        $opcion_envio = session('opcion_envio');
        //dd($opcion_envio);
        if($estado === 'fijo.catalogo.get'){
            $rutaBase = [
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
                    'permitidas' => ['fijo.catalogo.post'],
                    'siguiente' => 'fijo.calendario.post',
                ],
                'fijo.calendario.post' => [
                    'permitidas' => ['fijo.calendario.get'],
                    'siguiente' => 'fijo.detallesPedido.get',
                ],
                'fijo.detallesPedido.get' => [
                    'permitidas' => ['fijo.detallesPedido.get'],
                    'siguiente' => 'fijo.detallesPedido.post',
                ],
                'fijo.detallesPedido.post' => [
                    'permitidas' => ['fijo.detallesPedido.post'],
                    'siguiente' => ($opcion_envio==='Domicilio')? 'fijo.direccion.get' : 'fijo.ticket.get', // Fin del flujo
                ],
            ];
            if($opcion_envio==='Domicilio'){
                $rutaComplementaria = [
                    'fijo.direccion.get' => [
                        'permitidas' => ['fijo.direccion.get'],
                        'siguiente' => 'fijo.direccion.post',
                    ],
                    'fijo.direccion.post' => [
                        'permitidas' => ['fijo.direccion.post'],
                        'siguiente' => 'fijo.ticket.get',
                    ],
                    'fijo.ticket.get' => [
                        'permitidas' => ['fijo.ticket.get'],
                        'siguiente' => null,
                    ],
                ];
            }
            else{
                $rutaComplementaria = [
                    'fijo.ticket.get' => [
                        'permitidas' => ['fijo.ticket.get'],
                        'siguiente' => null,
                    ],
                ];
            }
            return array_merge($rutaBase, $rutaComplementaria);
        }
        if($estado === 'personalizado.catalogo.get'){

        }

        if($estado === 'emergente.catalogo.get'){

        }

    }   
}
