<?php

namespace App\Http\Controllers;

use App\Mail\Correo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailController extends Controller
{
    public function mostrar()
    {
        return view('prueba-recuperacion');
    }   
}
