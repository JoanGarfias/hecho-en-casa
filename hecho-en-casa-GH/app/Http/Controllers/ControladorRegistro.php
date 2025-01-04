<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorRegistro extends Controller
{
    public function index(){
        return view('registrar');
    }

    public function registrar(Request $request){
        $nombre = $request->input('name');
        $apellido_paterno = $request->input('apellidoP');
        $apellido_materno = $request->input('apellidoM');
        $telefono = $request->input('phone');
        $correo = $request->input('email');
        $action = $request->input('action');
        
        session([
            'nombre'=>$nombre,
            'apellido_paterno' => $apellido_paterno,
            'apellido_materno' => $apellido_materno,
            'telefono' => $telefono,
            'correo' => $correo,
        ]);

        if($action === 'login'){
            return redirect()->route('login.index');
        }elseif($action === 'register'){
            return redirect()->route('registrar.contrasena');
        }
    }

    public function contrasena(){
        return view('contrasena');
    }

    public function guardarContrasena(Request $request){
        dd($request->all());
        $constrasena = $request->input('password');
    }
}
