<?php

use App\Exceptions\CalendarioException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ProtectorPeticiones;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'protector.peticiones' => ProtectorPeticiones::class
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (QueryException $e, Request $request) {
            Log::error('Excepción capturada: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return response()->view('errors.database', ['message' => $e->getMessage()], 500);
        });
        
        $exceptions->render(function (HttpException $e, Request $request) {
            Log::error('Excepción capturada: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return response()->view('errors.http', ['message' => $e->getMessage()], $e->getStatusCode());
        });

        $exceptions->render(function (CalendarioException $e, Request $request) {
            Log::error('Excepción capturada: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return $e->render($request);
        });

        $exceptions->render(function (Throwable $e, Request $request) {
            Log::error('Excepción capturada: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return response()->view('errors.generico', ['message' => $e->getMessage()], 500);
        });
    })->create();
