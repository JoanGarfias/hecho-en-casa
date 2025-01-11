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

        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'telefono' => 'required|numeric|digits_between:10,15',
            'apellidoP' => 'required|string|max:255',
            'apellidoM' => 'required|string|max:255',
            'g-recaptcha-response' => 'required|captcha',  // Validación del reCAPTCHA
        ], [
            'g-recaptcha-response.required' => 'Por favor, confirma que no eres un robot.',
            'g-recaptcha-response.captcha' => 'La validación de seguridad falló. Por favor, intenta nuevamente.',  // Mensaje personalizado
        ]);
        
        $nombre = $credentials['name'];
        $apellido_paterno = $credentials['apellidoP'];
        $apellido_materno = $credentials['apellidoM'];
        $telefono = $credentials['phone'];
        $correo = $credentials['email'];
        
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
        $usuario->Codigo_postal_u = $request->input('codigoPostal'); 
        $usuario->estado_u = $request->input('estado');
        $usuario->ciudad_u = $request->input('ciudad');
        $usuario->colonia_u = $request->input('colonia');
        $usuario->calle_u = $request->input('calle');
        $usuario->num_exterior_u = $request->input('num'); ///<-----------AQUI SE TIENE QUE SEPARAR EN DOS CAMPOS
        //$usuario->referencia_u = $request->input('referencia');
        $usuario->contraseña = bcrypt(session('contrasena'));
        try{
            $usuario->save();
        }catch(\Exception $e){
            return redirect()->route('registrar.get')->with('error', 'Error al guardar el usuario');    
        }
        Mail::to($usuario->correo_electronico)->send(new CorreoRegistro($usuario->nombre));
        return redirect()->route('login.get');
    }

    public function mostrarRecuperacion()
    {
        return view('prueba-recuperacion');
    } 

    public function validarRecuperacion(Request $request, $token = null){
        if(!$token){
            return redirect()->route('inicio.get')->withErrors(['error' => 'Token no proporcionado']);
        }
        $usuario = Usuario::where('token_recuperacion', $token)->first();
        if ($usuario){
            session([
                'usuario' => $usuario->id_u,
                'proceso_recuperacion' => $request->route()->getName(),
            ]);
            return view('cambiar-contrasenaPrueba');
        } 
        return view('inicio', [
            'error' => 'Token inválido',
        ]);
        
    }

    public function actualizarContrasena(Request $request){
        $contrasena = $request->input('confirmar_contraseña');
        $usuario = usuario::where('id_u', session('usuario'))->first();
        if ($usuario){
            $usuario->contraseña = bcrypt($contrasena);
            $usuario->token_recuperacion = null;
            try{
                $usuario->save();
            }catch(\Exception $e){
                return redirect()->route('login.get')->with('error', 'Error al actualizar la contraseña');
            }
        }

        return redirect()->route('login.get');
    }
}
