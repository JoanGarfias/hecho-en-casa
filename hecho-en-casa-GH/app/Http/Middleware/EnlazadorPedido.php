<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnlazadorPedido
{
    private $rutasBase = [
        'fijo' => [
            'fijo.catalogo.post' => ['fijo.catalogo.get'],
            'fijo.calendario.get' => ['fijo.catalogo.post', 'fijo.detallesPedido.get', 'fijo.calendario.post', 'fijo.detallesPedido.post', 'fijo.calendario.get'],
            'fijo.calendario.post' => ['fijo.calendario.get', 'fijo.detallesPedido.get'],
            'fijo.detallesPedido.get' => ['fijo.calendario.post', 'fijo.detallesPedido.get'],
            'fijo.detallesPedido.post' => ['fijo.detallesPedido.get'],
        ],
        'personalizado' => [
            'personalizado.catalogo.post' => ['personalizado.catalogo.get'],
            'personalizado.calendario.get' => ['personalizado.catalogo.post', 'personalizado.detallesPedido.get', 'personalizado.calendario.post', 'personalizado.detallesPedido.post', 'fijo.calendario.get'],
            'personalizado.calendario.post' => ['personalizado.calendario.get', 'personalizado.detallesPedido.get'],
            'personalizado.detallesPedido.get' => ['personalizado.calendario.post', 'personalizado.detallesPedido.get'],
            'personalizado.detallesPedido.post' => ['personalizado.detallesPedido.get'],
        ],
        'emergente' => [
            'emergente.catalogo.post' => ['emergente.catalogo.get'],
            'emergente.calendario.get' => ['emergente.catalogo.post', 'emergente.detallesPedido.get', 'emergente.calendario.post', 'emergente.detallesPedido.post', 'fijo.calendario.get'],
            'emergente.calendario.post' => ['emergente.calendario.get', 'emergente.detallesPedido.get'],
            'emergente.detallesPedido.get' => ['emergente.calendario.post', 'emergente.detallesPedido.get'],
            'emergente.detallesPedido.post' => ['emergente.detallesPedido.get'],
        ],
    ];

    private $rutasSinCache = [
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

    public function handle($request, Closure $next)
    {
        $rutaActual = $request->route()->getName();
        $rutaAnterior = session()->get('proceso_compra');
        $tipopostre = session('id_tipopostre');
        $opcion_envio = session()->get('opcion_envio');
        $flujo = $this->obtenerFlujo($tipopostre, $opcion_envio);

        if ($this->datosSesionInvalidos($rutaAnterior, $rutaActual, $tipopostre)) {
            $this->olvidarDatos($rutaAnterior, $tipopostre, $opcion_envio);
            return redirect()->route($this->obtenerPaginaRegreso($tipopostre))->with('error', 'No sigue la estructura de la ruta.');
        }

        if ($flujo === null || !isset($flujo[$rutaActual])) {
            $this->olvidarDatos($rutaAnterior, $tipopostre, $opcion_envio);
            return redirect()->route($this->obtenerPaginaRegreso($tipopostre))->with('error', 'No sigue la estructura de la ruta.');
        }

        $aceptadas = $flujo[$rutaActual];
        if (!in_array($rutaAnterior, $aceptadas)) {
            $this->olvidarDatos($rutaAnterior, $tipopostre, $opcion_envio);
            return redirect()->route($this->obtenerPaginaRegreso($tipopostre))->with('error', 'No sigue la estructura de la ruta.');
        }

        // Ejecuta $next($request) una sola vez y pasa la respuesta a eliminarCache.
        $response = $next($request);
        return $this->eliminarCache($rutaActual, $response, $opcion_envio, $tipopostre) ?? $response;

    }

    private function obtenerFlujo($tipopostre, $opcion_envio)
    {
        $rutaBase = $this->rutasBase[$tipopostre] ?? null;

        if ($rutaBase === null) {
            return null;
        }

        if ($opcion_envio === "Domicilio") {
            $flujoEnvio = [
                $tipopostre . '.direccion.get' => [$tipopostre . '.detallesPedido.post'],
                $tipopostre . '.direccion.post' => [$tipopostre . '.direccion.get'],
                $tipopostre . '.ticket.get' => [$tipopostre . '.direccion.post'],
            ];
            return array_merge($rutaBase, $flujoEnvio);
        } elseif ($opcion_envio === "Sucursal") {
            return array_merge($rutaBase, [$tipopostre . '.ticket.get' => [$tipopostre . '.detallesPedido.post']]);
        }

        return $rutaBase;
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

    private function obtenerPaginaRegreso($tipopostre)
    {
        return $tipopostre ? $tipopostre . '.catalogo.get' : 'inicio.get';
    }

    private function eliminarCache($vista, $response, $opcion_envio, $tipopostre)
    {
        if (in_array($vista, $this->rutasSinCache)) {
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
            return $response;
        }

        if ($opcion_envio === "Sucursal") {
            $rutaDireccion = $tipopostre . '.detallesPedido.get';
            if ($vista === $rutaDireccion) {
                $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
                $response->headers->set('Pragma', 'no-cache');
                $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
                return $response;
            }
        }

        return null;
    }

    private function olvidarDatos(... $datos){
        foreach($datos as $dato){
            if($dato !== null){
                session()->forget($dato);
            }
        }
    }

}

?>