<?php

namespace App\Http\Controllers;

use App\Mail\Correo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ControladorLogin extends Controller
{
    public function mostrarLogin()
    {   
        return view('iniciar-sesion');
    }

    public function Logear(Request $request)
    {
        $action = $request->input('action');//esto borrar
        if($action === 'login'){
            
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'g-recaptcha-response' => 'required|captcha',
            ]);
    
            $usuario = Usuario::select('id_u', 'contraseña')
            ->where('correo_electronico', $credentials['email'])
            ->first();

            if ($usuario && Hash::check($credentials['password'], $usuario->contraseña)) {
                // Generar un nuevo token de sesión encriptado
                $sessionToken = bin2hex(random_bytes(32));

                $usuario->update([
                    'token_sesion' => $sessionToken,
                ]);
                // Crear la galleta con el token de sesión y el id
                $userId = $usuario ? $usuario->id_u : null; // Devuelve el id si existe, o si no devuelve null
                Cookie::queue('user_id', $userId, 60 * 72);
                return redirect()->route('inicio.get')->withCookie(cookie('session_token', $sessionToken, 60 * 72)); // 72 horas
            }
            else{
                return redirect()->route('login.get')->withErrors(['correo_electronico' => 'Credenciales incorrectas.']);
            }
        }elseif($action === 'recuperar'){
            
            $credentials = $request->validate([
                'email' => 'required|email',
            ]);
    
            $usuario = Usuario::where('correo_electronico', $credentials['email'])->first();
            if($usuario){
                $correo = $credentials['email'];
                $token = Str::random(64);
                Mail::to($correo)->send(new Correo($token));
                $usuario->token_recuperacion = $token;
                try{
                    $usuario->save();
                }catch(\Exception $e){
                    return redirect()->route('inicio.get')
                    ->with('error', 'Error al guardar el usuario');    
                }
                session([
                    'correo' => $correo,
                ]);

                return redirect()->back()
                ->with('success', 'Se ha enviado un enlace de recuperación a tu correo.');
            }
            return redirect()->back()
                ->with('error', 'Correo no registrado.');
        }elseif($action === 'register'){
            return redirect()->route('registrar.get');
        }
    }

    public function logout(Request $request)
    {
        //conseguir galleta
        $sessionToken = $request->cookie('session_token');
    
        if ($sessionToken) {
            // Buscar al usuario con ese token de sesión
            $usuario = Usuario::where('token_sesion', $sessionToken)->first();
    
            if ($usuario) {
                //Se elimina el token de la bd
                $usuario->update(['token_sesion' => null]);
            }
        }
    
        // Eliminar la galleta porque cerró sesión
        Cookie::queue('user_id', $usuario->id_u, -600);
        return redirect('/')->withCookie(cookie()->forget('session_token'));
    }
    
}
