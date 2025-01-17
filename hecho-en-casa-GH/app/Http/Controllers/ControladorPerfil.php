<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class ControladorPerfil extends Controller
{
    public function mostrar(){
        $id = Cookie::get('user_id');
        $usuario = Cache::remember('usuario', 30, function () use ($id){
            return usuario::where('id_u', $id)->first();
        });
        if($id == null){
            return redirect()->route('inicio.get')->with('error', 'Ocurrio un error,cierra tu sesion e inicia sesion otra vez');
        }else{
            return view('Perfil');
        }
        
    }

    public function datosUsuario(){
        $id = Cookie::get('user_id');
        $usuario = Cache::remember('usuario', 30, function () use ($id){
            return usuario::where('id_u', $id)->first();
        });
        return json_encode($usuario);
    }

    public function editar(Request $request){
        $id = Cookie::get('user_id');
        $usuario = Cache::remember('usuario', 30, function () use ($id){
            return usuario::where('id_u', $id)->first();
        });

        if(Cache::get('usuario') == null){
            return redirect()->route('inicio.get')->with('error', 'Error: No existe sesion del usuario');
        }

        $cambiarcontrasena = $request->input('cambiarcontrasena');
        $cambiardomicilio = $request->input('cambiardomicilio');
        $cambiartelefono = $request->input('cambiartelefono');

        //La idea es la siguiente, existen 3 botones de editar, y estos, al activarse, quitaran el atributo readonly del input, y se podra modificar lo
        //que lleva adentro. Entonces, al presionar el boton dedicado guardar, se va a guardar la seleccion del usuario con una consulta, dependiendo de los botones 
        //activos en ese momento, para no tener que cambiar los 3 atributos a la vez si solo se cambia uno

        if($cambiartelefono == true){//Si el boton de editar telefono esta activo
            $telefono = $request->input('telefono');
            try{
                $updateTelefonotry = Usuario::select('telefono')
                ->where('id_u', Cache::get('usuario')->id_u)->update([
                    'telefono' => $telefono,
                ]);
            }catch(\Exception $e){
                return redirect()->route('inicio.get')->with('error', 'Error al actualizar el telefono');
            }
        }
        if($cambiardomicilio == true){//Si el boton de editar ubicacion esta activo
            $Codigo_postal_u = $request->input('codigopostal'); 
            $estado_u = $request->input('estado');
            $ciudad_u = $request->input('ciudad');
            $colonia_u = $request->input('colonia');
            $calle_u = $request->input('calle');
            $num_exterior_u = $request->input('NumExt');
            $num_interior_u = $request->input('NumInt');
            $referencia_u = $request->input('referencia');
            try{
                $updateTelefonotry = Usuario::select('Codigo_postal_u','estado_u','ciudad_u','colonia_u','calle_u','num_exterior_u','num_interior_u','referencia_u',)
                ->where('id_u', Cache::get('usuario')->id_u)->update([
                    'Codigo_postal_u' => $Codigo_postal_u,
                    'estado_u' => $estado_u,
                    'ciudad_u' => $ciudad_u,
                    'colonia_u' => $colonia_u,
                    'calle_u' => $calle_u,
                    'num_exterior_u' => $num_exterior_u,
                    'num_interior_u' => $num_interior_u,
                    'referencia_u' => $referencia_u,
                ]);
            }catch(\Exception $e){
                return redirect()->route('inicio.get')->with('error', 'Error al actualizar el domicilio');
            }
        }
        if($cambiarcontrasena == true){//Si el boton de editar contraseña esta activo
            $contrasena = bcrypt($request->input('contrasena'));
            try{
                $updateTelefonotry = Usuario::select('contraseña')
                ->where('id_u', Cache::get('usuario')->id_u)->update([
                    'contraseña' => $contrasena,
                ]);
            }catch(\Exception $e){
                return redirect()->route('inicio.get')->with('error', 'Error al actualizar la contraseña');
            }
        }
        
        Cache::forget('usuario');
        return redirect()->route('perfil.get');
    }
}
