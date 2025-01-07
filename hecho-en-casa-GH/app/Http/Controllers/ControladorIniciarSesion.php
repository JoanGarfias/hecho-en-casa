<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ControladorIniciarSesion extends Controller
{
    public function index(){
        return view('iniciar-secion');
    }
}
