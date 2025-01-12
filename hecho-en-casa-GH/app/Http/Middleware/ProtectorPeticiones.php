<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class ProtectorPeticiones
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $maxAttempts  Número máximo de intentos permitidos
     * @param  int  $decayMinutes  Tiempo en minutos para restablecer el contador
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next, $maxAttempts = 60, $decayMinutes = 1)
    {
        $ip = $request->ip();
        $cacheKey = "limitador_de_peticiones:{$ip}";
        $intentos = Cache::get($cacheKey, 0);
    
        if ($intentos >= $maxAttempts) {
            $reintentarDespues = Cache::get(
                "{$cacheKey}:temporizador", 
                now()->addMinutes($decayMinutes)->timestamp - now()->timestamp
            );
    
            // Lanza la excepción que Laravel manejará
            throw new TooManyRequestsHttpException(
                now()->addMinutes($decayMinutes)->timestamp - now()->timestamp,
                'Has realizado demasiadas peticiones. Por favor, intenta más tarde.'
            );
        }
    
        Cache::put($cacheKey, $intentos + 1, now()->addMinutes($decayMinutes));
        if ($intentos === 0) {
            Cache::put("{$cacheKey}:temporizador", now()->addMinutes($decayMinutes)->timestamp, now()->addMinutes($decayMinutes));
        }
    
        return $next($request);
    }
    
    
}
