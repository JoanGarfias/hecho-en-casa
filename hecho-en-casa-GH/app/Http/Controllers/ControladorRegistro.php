<?php

namespace App\Http\Controllers;

use App\Mail\Correo;
use App\Mail\CorreoRegistro;
use App\Models\usuario;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ControladorRegistro extends Controller
{
    public function index(Request $request){
        /*ENLAZADOR DE REGISTRO */
        session()->put('proceso_registro', $request->route()->getName());

        return view('registrar');
    }

    public function registrar(Request $request){
        /*ENLAZADOR DE REGISTRO */
        session()->put('proceso_registro', $request->route()->getName());
        /*ENLAZADOR DE REGISTRO */
        
        $request->validate([
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $nombre = $request->input('name');
        $apellido_paterno = $request->input('apellidoP');
        $apellido_materno = $request->input('apellidoM');
        $telefono = $request->input('phone');
        $correo = $request->input('email');
        
        $correo_existe = usuario::where('correo_electronico', $correo)->first();

        if ($correo_existe) {
            // Redirigir de vuelta con un mensaje de error
            return redirect()->back()
            ->withErrors(['email' => 'El correo ya está registrado. Por favor, ingresa otro.'])
            ->withInput();
        }

        $action = $request->input('action');
        
        session([
            'nombre'=>$nombre,
            'apellido_paterno' => $apellido_paterno,
            'apellido_materno' => $apellido_materno,
            'telefono' => $telefono,
            'correo' => $correo,
        ]);

        if($action === 'login'){
            return redirect()->route('login.get');
        }elseif($action === 'register'){
            return redirect()->route('registrar.contrasena.get');
        }
    }

    public function contrasena(Request $request){
        /*ENLAZADOR DE REGISTRO */
        session()->put('proceso_registro', $request->route()->getName());
        /*ENLAZADOR DE REGISTRO */

        return view('contrasena');
    }

    public function guardarContrasena(Request $request){
        /*ENLAZADOR DE REGISTRO */
        session()->put('proceso_registro', $request->route()->getName());
        /*ENLAZADOR DE REGISTRO */

        $contrasena = $request->input('confirmacion');
        session(['contrasena' => $contrasena]);
        return redirect()->route('registrar.direccion.get'); 
    }

    public function mostrarDireccion(Request $request){
        /*ENLAZADOR DE REGISTRO */
        session()->put('proceso_registro', $request->route()->getName());
        /*ENLAZADOR DE REGISTRO */

        return view('direccion');
    }

    public function guardarDireccion(Request $request){
        /*ENLAZADOR DE REGISTRO */
        session()->put('proceso_registro', $request->route()->getName());
        /*ENLAZADOR DE REGISTRO */

        $usuario = new usuario;
        $usuario->correo_electronico = session('correo');
        $usuario->nombre = session('nombre');
        $usuario->apellido_paterno = session('apellido_paterno');
        $usuario->apellido_materno = session('apellido_materno');
        $usuario->telefono = session('telefono');
        $usuario->Codigo_postal_u = $request->input('codigo_postal'); 
        $usuario->estado_u = $request->input('estado');
        $usuario->ciudad_u = $request->input('municipio');
        $usuario->colonia_u = $request->input('asentamiento');
        $usuario->calle_u = $request->input('calle');
        $usuario->num_interior_u = $request->input('numInt');
        $usuario->num_exterior_u = $request->input('numExt');
         ///<-----------AQUI SE TIENE QUE SEPARAR EN DOS CAMPOS
        $usuario->referencia_u = $request->input('referencias');
        $usuario->contraseña = bcrypt(session('contrasena'));
        try{
            $usuario->save();
        }catch(\Exception $e){
            return redirect()->route('registrar.get')->with('errorRegistro', 'Error al guardar el usuario');    
        }
        
        Mail::to($usuario->correo_electronico)->send(new CorreoRegistro($usuario->nombre));
        return redirect()->route('login.get');
    }

    public function mostrarRecuperacion()
    {
        return view('prueba-recuperacion');
    } 

    public function validarRecuperacion(Request $request, $token = null){
        if($token===null){
            return redirect()->route('inicio.get')->withErrors(['errorToken' => 'Token no proporcionado.']);
        }
        $usuario = Usuario::where('token_recuperacion', $token)->first();
        
        if ($usuario){
            session([
                'usuario' => $usuario->id_u,
                'proceso_recuperacion' => $request->route()->getName(),
            ]);
            return view('recuperacioncontrasena');
        } 
        return redirect()->route('inicio.get')->withErrors(['errorValidacion' => 'Token no valido.']);
        
    }

    public function actualizarContrasena(Request $request){
        $contrasena = $request->input('confirmacion');
        $usuario = usuario::where('id_u', session('usuario'))->first();
        if ($usuario){
            $usuario->contraseña = bcrypt($contrasena);
            $usuario->token_recuperacion = null;
            try{
                $usuario->save();
            }catch(\Exception $e){
                return redirect()->route('login.get')->withErrors(['errorKey' => 'Error al actualizar la contraseña.']);
            }
        }

        return redirect()->route('login.get');
    }
}
