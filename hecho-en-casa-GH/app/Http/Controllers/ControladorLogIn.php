<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorLogIn extends Controller
{
    public function index(){
        return view('iniciar-sesion');
    }
}
