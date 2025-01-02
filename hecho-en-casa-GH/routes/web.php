<?php

use App\Models\Elemento;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $elemento = new Elemento;
    $elemento->nom_elemento = 'Ejemplo';
    $elemento->precio_e = 0.0;
    $elemento->save();
    return $elemento;
});

Route::get('prueba', function(){
    
});
//Comentario


//Este comentario está bien chido

//Prueba 123