<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorCalendario extends Controller
{
    public function index(){
        return view('registrar');
    }
}
