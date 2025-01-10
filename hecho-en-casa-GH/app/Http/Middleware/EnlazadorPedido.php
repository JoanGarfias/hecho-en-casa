<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnlazadorPedido
{
    public function handle($request, Closure $next)
    {

        /*Obtengo los datos necesarios para redireccion */
        $rutaActual = $request->route()->getName();
        $rutaAnterior = session()->get('proceso_compra');
        $tipopostre = session('id_tipopostre');
        $opcion_envio = session()->get('opcion_envio');
        

        /*Determino el flujo directo e inverso de cada ruta*/
        $flujo = $this->obtenerFlujo($tipopostre, $opcion_envio);

        /*Valido los datos*/
        if ($this->datosSesionInvalidos($rutaAnterior, $rutaActual, $tipopostre)) {
            $pag_regreso = $this->obtenerPaginaRegreso($tipopostre);
            return redirect()->route($pag_regreso)->with('error', 'No sigue la estructura de la ruta.');
        }

        //Se valida aparte porque es una matriz
        if ($flujo === null) {
            $pag_regreso = $this->obtenerPaginaRegreso($tipopostre);
            return redirect()->route($pag_regreso)->with('error', 'No sigue la estructura de la ruta.');
        }
        
        //Validamos que existe la ruta en la matriz
        if(!isset($flujo[$rutaActual])){
            $pag_regreso = $this->obtenerPaginaRegreso($tipopostre);
            return redirect()->route($pag_regreso)->with('error', 'No sigue la estructura de la ruta.');
        }

        /*Obtenemos las paginas aceptadas por la ruta actual, ya sea directo o inverso*/
        $aceptadas = $flujo[$rutaActual];
        $pagina_aceptada = null;
        foreach($aceptadas as $aceptada){
            if($aceptada === $rutaAnterior){
                $pagina_aceptada = $rutaActual; //Aqui se encuentra una página aceptada en la matriz
            }
        }

        if($pagina_aceptada === null){ //Si no está la página en la matriz redireccionamos a otro lado
            $pag_regreso = $this->obtenerPaginaRegreso($tipopostre);
            return redirect()->route($pag_regreso)->with('error', 'No sigue la estructura de la ruta.');
        }

        /*Intentamos eliminar la caché de la página para que no se pueda
        avanzar o retroceder con las flechitas del navegador, este apartado se sigue según el prototipo */
        $respuesta = $this->eliminarCache($rutaActual, $next($request), $opcion_envio, $tipopostre);
        if($respuesta !== null){
            return $respuesta; //Retornamos el $next($request) pero sin caché
        }

        /*Retornamos el $next($request) normal*/
        return $next($request);
    }

    private function obtenerFlujo($tipopostre, $opcion_envio)
    {
        /*Aqui obtenemos el flujo de la compra según el tipo de postre y la opción de envío*/

        if ($tipopostre === "fijo") {
            $rutaBase = [
                'fijo.catalogo.post' => ['fijo.catalogo.get'],
                'fijo.calendario.get' => ['fijo.catalogo.post', 'fijo.detallesPedido.get'],
                'fijo.calendario.post' => ['fijo.calendario.get', 'fijo.detallesPedido.get'],
                'fijo.detallesPedido.get' => ['fijo.calendario.post'],
                'fijo.detallesPedido.post' => ['fijo.detallesPedido.get'],
            ];
    
            if ($opcion_envio === "Domicilio") {
                $flujoEnvioDomicilio = [
                    'fijo.direccion.get' => ['fijo.detallesPedido.post'],
                    'fijo.direccion.post' => ['fijo.direccion.get'],
                    'fijo.ticket.get' => ['fijo.direccion.post'],
                ];
                return array_merge($rutaBase, $flujoEnvioDomicilio);
            } elseif ($opcion_envio === "Sucursal") {
                $flujoEnvioSucursal = [
                    'fijo.ticket.get' => ['fijo.detallesPedido.post'],
                ];
                return array_merge($rutaBase, $flujoEnvioSucursal);
            }
            else{
                return $rutaBase;
            }
        }
        else if($tipopostre === "personalizado"){
            $rutaBase = [
                'personalizado.catalogo.post' => ['personalizado.catalogo.get'],
                'personalizado.calendario.get' => ['personalizado.catalogo.post', 'personalizado.detallesPedido.get'],
                'personalizado.calendario.post' => ['personalizado.calendario.get', 'personalizado.detallesPedido.get'],
                'personalizado.detallesPedido.get' => ['personalizado.calendario.post'],
                'personalizado.detallesPedido.post' => ['personalizado.detallesPedido.get'],
            ];
    
            if ($opcion_envio === "Domicilio") {
                $flujoEnvioDomicilio = [
                    'personalizado.direccion.get' => ['personalizado.detallesPedido.post'],
                    'personalizado.direccion.post' => ['personalizado.direccion.get'],
                    'personalizado.ticket.get' => ['personalizado.direccion.post'],
                ];
                return array_merge($rutaBase, $flujoEnvioDomicilio);
            } elseif ($opcion_envio === "Sucursal") {
                $flujoEnvioSucursal = [
                    'personalizado.ticket.get' => ['personalizado.detallesPedido.post'],
                ];
                return array_merge($rutaBase, $flujoEnvioSucursal);
            }
            else{
                return $rutaBase;
            }
        }
        else if($tipopostre === "emergente"){
            $rutaBase = [
                'emergente.catalogo.post' => ['emergente.catalogo.get'],
                'emergente.calendario.get' => ['emergente.catalogo.post', 'emergente.detallesPedido.get'],
                'emergente.calendario.post' => ['emergente.calendario.get', 'emergente.detallesPedido.get'],
                'emergente.detallesPedido.get' => ['emergente.calendario.post'],
                'emergente.detallesPedido.post' => ['emergente.detallesPedido.get'],
            ];
    
            if ($opcion_envio === "Domicilio") {
                $flujoEnvioDomicilio = [
                    'emergente.direccion.get' => ['emergente.detallesPedido.post'],
                    'emergente.direccion.post' => ['emergente.direccion.get'],
                    'emergente.ticket.get' => ['emergente.direccion.post'],
                ];
                return array_merge($rutaBase, $flujoEnvioDomicilio);
            } elseif ($opcion_envio === "Sucursal") {
                $flujoEnvioSucursal = [
                    'emergente.ticket.get' => ['emergente.detallesPedido.post'],
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
        /*Obtenemos la página a donde vamos a regresar, dependiendo del tipo de postre
        si existen más apartados en el futuro deberán seguir la convención de nombramiento de rutas 
        para que se pueda seguir utilizando esta funcionalidad*/
        if($tipopostre === null){
            return 'inicio.get';
        }
        return $tipopostre . '.catalogo.get';
    }

    private function eliminarCache($vista, $response, $opcion_envio, $tipopostre){
        /*Esta función permite que no se pueda avanzar o retroceder con las flechitas del navegador,
        obliga al usuario a recargar la página y por lo tanto entra la validación del middleware
        (el Enlazador directo / inverso) */
        
        $rutasSinCache = [
            'fijo.detallesPedido.get',
            'fijo.direccion.get',
            'fijo.ticket.get',
            'personalizado.detallesPedido.get',
            'personalizado.direccion.get',
            'personalizado.ticket.get',
            'emergente.detallesPedido.get',
            'emergente.direccion.get',
            'emergente.ticket.get',
        ];

        if($opcion_envio==="Sucursal"){
            $rutaDireccion = $tipopostre . '.detallesPedido.get';
            $rutasSinCache[] = $rutaDireccion;
        }

        if (in_array($vista, $rutasSinCache)) {
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
            return $response;
        }
        return null;
    }

}
