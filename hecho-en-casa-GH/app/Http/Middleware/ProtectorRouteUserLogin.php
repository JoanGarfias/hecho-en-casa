<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ProtectorRouteUserLogin
{
    public function handle(Request $request, Closure $next)
    {
        //Todavia falta el codigo xd
        return $next($request);
    }
}
