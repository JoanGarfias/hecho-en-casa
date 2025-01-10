<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnlazadorRegistro
{
    private $rutasBase = [
        'registrar.post' => ['registrar.get'],
        'registrar.contrasena.get' => ['registrar.post'],
        'registrar.contrasena.post' => ['registrar.contrasena.get'],
        'registrar.direccion.get' => ['registrar.contrasena.post'],
        'registrar.direccion.post' => ['registrar.direccion.get'],
    ];

    private $rutasSinCache = [
        'registrar.post',
        'registrar.contrasena.get',
        'registrar.contrasena.post',
        'registrar.direccion.get',
        'registrar.direccion.post'
    ];

    public function handle($request, Closure $next)
    {
        $rutaActual = $request->route()->getName();
        $rutaAnterior = session()->get('proceso_registro');
        $flujo = $this->obtenerFlujo();

        if ($this->datosSesionInvalidos($rutaAnterior, $rutaActual)) {
            dd("Datos nulos", $rutaActual, $rutaAnterior);
            return redirect()->route($this->obtenerPaginaRegreso())->with('error', 'No sigue la estructura de la ruta de registro.');
        }

        if ($flujo === null || !isset($flujo[$rutaActual])) {
            dd("Flujo invalido", $flujo, $rutaActual, $flujo[$rutaActual]);
            return redirect()->route($this->obtenerPaginaRegreso())->with('error', 'No sigue la estructura de la ruta de registro.');
        }

        $aceptadas = $flujo[$rutaActual];
        if (!in_array($rutaAnterior, $aceptadas)) {
            dd("No es una pagina dentro de las aceptadas", $rutaActual, $rutaAnterior, $aceptadas);
            return redirect()->route($this->obtenerPaginaRegreso())->with('error', 'No sigue la estructura de la ruta de registro.');
        }

        $respuesta = $this->eliminarCache($rutaActual, $next($request));
        if ($respuesta !== null) {
            return $respuesta;
        }

        return $next($request);
    }

    private function obtenerFlujo()
    {
        return $this->rutasBase;
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

    private function obtenerPaginaRegreso()
    {
        return 'registrar.get';
    }

    private function eliminarCache($vista, $response)
    {
        if (in_array($vista, $this->rutasSinCache)) {
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
            return $response;
        }
        else{
            return null;
        }
    }
}

?>