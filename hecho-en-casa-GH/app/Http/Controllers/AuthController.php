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

class AuthController extends Controller
{
    public function mostrarLogin()
    {   
        return view('iniciar-sesion');
    }

    public function Logear(Request $request)
    {
        $action = $request->input('solicitud');//esto borrar
        
        if($action === 'login'){
            
            $credentials = $request->validate([
                'correo_electronico' => 'required|email',
                'contraseña' => 'required',
            ]);
    
            $usuario = Usuario::where('correo_electronico', $credentials['correo_electronico'])->first();
            if ($usuario && Hash::check($credentials['contraseña'], $usuario->contraseña)) {
                // Generar un nuevo token de sesión encriptado
                $sessionToken = bin2hex(random_bytes(32));
                session([
                    'id_usuario' => $usuario->id_u,
                ]);
                $usuario->update([
                    'token_sesion' => $sessionToken,
                ]);

                // Crear la galleta con el token de sesión
                return redirect()->route('inicio.get')->withCookie(cookie('session_token', $sessionToken, 60 * 72)); // 72 horas
            }

            return redirect('login.get')->withErrors(['correo_electronico' => 'Credenciales incorrectas.']);
        }elseif($action === 'recuperar'){
            
            $credentials = $request->validate([
                'correo_electronico' => 'required|email',
            ]);
    
            $usuario = Usuario::where('correo_electronico', $credentials['correo_electronico'])->first();
            if($usuario){
                $correo = $credentials['correo_electronico'];
                $token = Str::random(64);
                Mail::to($correo)->send(new Correo($token));
                $usuario->token_recuperacion = $token;
                try{
                    $usuario->save();
                }catch(\Exception $e){
                    dd("Error al guardar el postre emergente: ".$e->getMessage());
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
        return redirect('/')->withCookie(cookie()->forget('session_token'));
    }
    
}
