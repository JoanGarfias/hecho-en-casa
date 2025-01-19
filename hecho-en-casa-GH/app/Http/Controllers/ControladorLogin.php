<?php

namespace App\Http\Controllers;

use App\Mail\Correo;
use App\Models\usuario;
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
        if($action == 'login'){
            
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'g-recaptcha-response' => 'required|captcha',
            ]);
    
            $usuario = usuario::select('id_u', 'contraseña')
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
                
                //false para http only y que se pueda ver en JS
                Cookie::queue(cookie('session_token', $sessionToken, 60 * 72, null, null, false, false));
                Cookie::queue(cookie('user_id', $userId, 60 * 72, null, null, false, false));

                switch(session('id_tipopostre')){
                    case "fijo":
                        return redirect()->route('fijo.calendario.get');
                        break;
                    case "personalizado":
                        return redirect()->route('personalizado.calendario.get');
                        break;
                    case "emergente":
                        return redirect()->route('emergente.calendario.get');
                        break;
                    default:
                    return redirect()->route('inicio.get'); // 72 horas
                        break;
                }
            }
            else{
                return redirect()->route('login.get')->withErrors(['errorCredenciales' => 'Correo o contraseña incorrecta.']);
            }
        }elseif($action == 'recuperar'){
            
            $credentials = $request->validate([
                'email' => 'required|email',
            ]);
    
            $usuario = usuario::where('correo_electronico', $credentials['email'])->first();
            if($usuario){
                $correo = $credentials['email'];
                $token = Str::random(64);
                Mail::to($correo)->send(new Correo($token));
                $usuario->token_recuperacion = $token;
                try{
                    $usuario->save();
                }catch(\Exception $e){
                    return redirect()->route('inicio.get')
                    ->with('error', 'Error al recuperar contraseña');    
                }
                session([
                    'correo' => $correo,
                ]);

                return redirect()->back()
                ->with('success', 'Se ha enviado un enlace de recuperación a tu correo.');
            }
            return redirect()->back()
                ->with('errorCorreo', 'Correo no registrado.');
        }elseif($action == 'register'){
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
        
        session()->forget('id_tipopostre');

        // Eliminar cookies
        Cookie::queue(cookie('session_token', 0, -1, null, null, false, false));
        Cookie::queue(cookie('user_id', 0, -1, null, null, false, false));        

        // Opcional: Invalida la sesión en el servidor (si estás usando sesiones)
        return redirect()->route('login.get');
    }
    
}
