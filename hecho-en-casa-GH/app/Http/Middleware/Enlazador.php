<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Enlazador
{
    public function handle(Request $request, Closure $next)
    {
        $rutaActual = $request->route()->getName();
        $postAsignado = session()->get('proceso_compra');
        $tipopostre = session()->get('id_tipopostre');
        $opcion_envio = session()->get('opcion_envio');
        
        //dd($rutaActual);

        // Validar datos esenciales
        if ($this->datosSesionInvalidos($postAsignado, $rutaActual, $tipopostre)) {
            $pag_regreso = $this->obtenerPaginaRegreso($tipopostre);
            return redirect()->route($pag_regreso)->with('error', 'No sigue la estructura de la ruta.');
        }

        $flujo = $this->obtenerPostSecuencia($tipopostre, $opcion_envio);
        
        //dd($flujo);

        if ($flujo === null) {
            $pag_regreso = $this->obtenerPaginaRegreso($tipopostre);
            return redirect()->route($pag_regreso)->with('error', 'No sigue la estructura de la ruta.');
        }
        if(!isset($flujo[$rutaActual])){
            $pag_regreso = $this->obtenerPaginaRegreso($tipopostre);
            return redirect()->route($pag_regreso)->with('error', 'No sigue la estructura de la ruta.');
        }

        $postFlujo = $flujo[$rutaActual];
        if($postAsignado !== $postFlujo){
            $pag_regreso = $this->obtenerPaginaRegreso($tipopostre);
            return redirect()->route($pag_regreso)->with('error', 'No sigue la estructura de la ruta.');
        }

        return $next($request);
    }

    private function obtenerPostSecuencia($tipopostre, $opcion_envio)
    {
        if ($tipopostre === "fijo") {
            $rutaBase = [
                'fijo.calendario.get' => 'fijo.catalogo.post',
                'fijo.detallesPedido.get' => 'fijo.calendario.post',
            ];

            if ($opcion_envio === "Domicilio") {
                $flujoEnvioDomicilio = [
                    'fijo.direccion.get' => 'fijo.detallesPedido.post',
                    'fijo.ticket.get' => 'fijo.direccion.post',
                ];
                return array_merge($rutaBase, $flujoEnvioDomicilio);
            } elseif ($opcion_envio === "Sucursal") {
                $flujoEnvioSucursal = [
                    'fijo.ticket.get' => 'fijo.detallesPedido.post',
                ];
                return array_merge($rutaBase, $flujoEnvioSucursal);
            }
            else{
                return $rutaBase;
            }
        }
        else if($tipopostre === "personalizado"){
            $rutaBase = [
                'personalizado.calendario.get' => 'personalizado.catalogo.post',
                'personalizado.detallesPedido.get' => 'personalizado.calendario.post',
            ];

            if ($opcion_envio === "Domicilio") {
                $flujoEnvioDomicilio = [
                    'personalizado.direccion.get' => 'personalizado.detallesPedido.post',
                    'personalizado.ticket.get' => 'personalizado.direccion.post',
                ];
                return array_merge($rutaBase, $flujoEnvioDomicilio);
            } elseif ($opcion_envio === "Sucursal") {
                $flujoEnvioSucursal = [
                    'personalizado.ticket.get' => 'personalizado.detallesPedido.post',
                ];
                return array_merge($rutaBase, $flujoEnvioSucursal);
            }
            else{
                return $rutaBase;
            }
        }
        else if($tipopostre === "emergente"){
            $rutaBase = [
                'emergente.calendario.get' => 'emergente.catalogo.post',
                'emergente.detallesPedido.get' => 'emergente.calendario.post',
            ];

            if ($opcion_envio === "Domicilio") {
                $flujoEnvioDomicilio = [
                    'emergente.direccion.get' => 'emergente.detallesPedido.post',
                    'emergente.ticket.get' => 'emergente.direccion.post',
                ];
                return array_merge($rutaBase, $flujoEnvioDomicilio);
            } elseif ($opcion_envio === "Sucursal") {
                $flujoEnvioSucursal = [
                    'emergente.ticket.get' => 'emergente.detallesPedido.post',
                ];
                return array_merge($rutaBase, $flujoEnvioSucursal);
            }
            else{
                return $rutaBase;
            }
        }

        else{
            return null;
        }
    }

    private function datosSesionInvalidos(...$variables): bool
    {
        foreach ($variables as $variable) {
            if ($variable === null) {
                return true;
            }
        }
        return false;
    }

    private function obtenerPaginaRegreso($tipopostre){
        if($tipopostre === null){
            return 'inicio.get';
        }
        return $tipopostre . '.catalogo.get';
    }

}
