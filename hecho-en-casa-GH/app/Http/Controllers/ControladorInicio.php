<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorInicio extends Controller
{
    public function index(Request $request){
    // Obtener el valor de la cookie 'session_token'
        $sessionToken = $request->cookie('session_token');

    // Pasar el token a la vista
        return view('inicio', ['sessionToken' => $sessionToken]);
    }
}
