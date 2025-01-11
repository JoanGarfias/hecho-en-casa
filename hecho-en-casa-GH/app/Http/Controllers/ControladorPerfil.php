<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorPerfil extends Controller
{
    public function mostrar()
    {
        return view('perfil');
    }
}
