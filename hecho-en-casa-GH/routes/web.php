<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});
//Comentario
Route::get('/registrar', function () {
    return view('registrar');
})->name('registrar');



//Este comentario está bien chido

//Prueba 123