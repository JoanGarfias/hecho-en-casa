<?php

use App\Models\Elemento;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControladorInicio;
use App\Http\Controllers\ControladorCalendario;
use App\Http\Controllers\ControladorCatalogo;

Route::get('/', [ControladorInicio::class, 'index']);
Route::get('/inicio', [ControladorInicio::class, 'index']);
Route::get('/calendario', [ControladorCalendario::class, 'index']);
Route::get('/catalogo/{categoria?}', [ControladorCatalogo::class, 'mostrar']);


//Esta fue la prueba de Jeycson:

/*
Route::get('/', function () {
    $elemento = new Elemento;
    $elemento->nom_elemento = 'Ejemplo';
    $elemento->precio_e = 0.0;
    $elemento->save();
    return $elemento;
});

Route::get('prueba', function(){
    
});

*/