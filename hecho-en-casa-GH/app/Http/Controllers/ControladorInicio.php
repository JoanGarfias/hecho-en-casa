<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorInicio extends Controller
{
    public function index(){
        return "Bienvenido a Hecho en Casa";
    }
}
