<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function mostrarLogin()
    {   
        return view('iniciar-sesion');
    }

    public function logear(Request $request)
    {
        $credentials = $request->validate([
            'correo_electronico' => 'required|email',
            'contraseña' => 'required',
        ]);

        $usuario = Usuario::where('correo_electronico', $credentials['correo_electronico'])->first();

        if ($usuario && Hash::check($credentials['contraseña'], $usuario->contraseña)) {
            // Generar un nuevo token de sesión encriptado
            $sessionToken = bin2hex(random_bytes(32));

            $usuario->update([
                'token_sesion' => $sessionToken,
            ]);

            // Crear la galleta con el token de sesión
            return redirect()->route('inicio.get')->withCookie(cookie('session_token', $sessionToken, 60 * 72)); // 72 horas
        }

        return redirect('/login')->withErrors(['correo_electronico' => 'Credenciales incorrectas.']);
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
