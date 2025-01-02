<?php

use App\Models\Elemento;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Route;


Route::get('/', function(){
    return "Bienvenido a la página de inicio";
});

Route::get('/inicio', function(){
    return "Bienvenido a la página de inicio";
});



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