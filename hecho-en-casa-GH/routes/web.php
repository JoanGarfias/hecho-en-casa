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

Route::get('/calendario', function(){
    return "Estás viendo el calendario";
});

Route::get('/catalogo/{categoria?}', function($categoria){
    //Aquí se va cargar el catalogo de la categoria (por defecto pay)
    if($categoria){
        return "La categoria por defecto es pay";
    }
    return "Estás viendo el catalogo de {$categoria}";
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