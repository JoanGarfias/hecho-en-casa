<?php

use App\Models\Elemento;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControladorInicio;

Route::get('/', [ControladorInicio::class, 'index']);
Route::get('/inicio', [ControladorInicio::class, 'index']);

Route::get('/calendario', function(){
    return "Estás viendo el calendario";
});

Route::get('/catalogo/{categoria?}', function($categoria = null){
    //Aquí se va cargar el catalogo de la categoria (por defecto pay)
    if($categoria === null){
        return "La categoria por defecto es pay";
    }
    else{
        return "Estás viendo el catalogo de {$categoria}";
    }
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