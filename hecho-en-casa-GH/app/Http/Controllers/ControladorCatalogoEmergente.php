<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\Pedido;
use App\Models\Postreemergente;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ControladorCatalogoEmergente extends Controller
{
    public function mostrar(){
        session()->put('estado_flujo', 'emergente.catalogo.get');

        $emergentes = Cache::remember('catalogoemergentes', 600, function () {
            return [
                'temporada' => Catalogo::select('id_postre', 'imagen', 'id_tipo_postre')
                                    ->where('id_tipo_postre', 'temporada')
                                    ->where('disponible', '1')
                                    ->get(),

                'pop-up' => Catalogo::select('id_postre', 'imagen', 'id_tipo_postre', 'nombre', 'descripcion', 'stock')
                                    ->where('id_tipo_postre', 'pop-up')
                                    ->where('stock', '>', 0)
                                    ->get(),
            ];
        });

        if (!$emergentes) {
            Log::info('Cache is empty or expired.');
            return response()->json([]);
        }
        
        return response()->json($emergentes);
    }

    public function seleccionar(Request $request){
        $validated = $request->validate([
            'id_postre' => 'required|integer',
        ]);

        session([
            'postre' => $validated['id_postre'],
        ]);

        return redirect()->route('emergente.detallesPedido.get');
    }

    public function mostrarDetalles(){
        //ESTO DEBERIA JALARSE DE LA VISTA ANTERIOR AQUI SOLO VA UN EJEMP
        session([
            'id_u' => "1", //<----OJITO AQUI DEBERIA DE JALARSE EL ID DE LA SESION
            //RECORDARIO DE ACTUALIZAR ESTO CUANDO SE MANEJE LA SESION
            //TALVEZ AQUI GUARDEMOS EL ID DEL USUARIO O ANTES PERO HAY QUE RECUPERARLO CUANDO INICIE SESION
            //O DE LA CACHE CREO PERO CON RECORDATORIO ->>>>>>>>>>>>
            'fecha' => "2025-01-03",
            'hora_entrega' => "12:00",
            'postre' => "30",
            'cantidad_minima' => "4",
        ]);

        //ESTO ES LA CONSULTA A PARTIR DEL ID QUE ME LLEGO DE LA VISTA ANTERIOR
        $postre = Cache::remember('postresession', 10, function () {
            return Catalogo::where('id_postre', session('postre'))
                            ->first();
        });

        session([   
            'nombre_postre' => $postre->nombre,
        ]);

        return view('detallesEmergente');
    }

    public function seleccionarDetalles(Request $request){
        $validated = $request->validate([
            'cantidad' => 'required|integer',
            'tipo_entrega' => 'required',
        ]);

        $tipo_entrega = $validated['tipo_entrega'];
        session()->put('opcion_envio', $tipo_entrega);

        session([
            'cantidad_pedida' => $validated['cantidad'],
            'tipo_entrega' => $validated['tipo_entrega'],
        ]);

        if($tipo_entrega === 'Domicilio'){
            return redirect()->route('emergente.direccion.get');  //SI SELECCIONO ENTREGA A DOMICILIO ENTONCES NOS VAMOS A DETALLES DIRECCION
        }

        $id_postre = session('postre');
        $postre = Cache::remember('postres2', 10, function () use ($id_postre){
            Catalogo::where('id_postre', $id_postre)
                            ->first();
        });

        $emergente = new Postreemergente;
        $emergente->id_postre_elegido = $postre->id_postre;
        try{
            $emergente->save();
        }catch(\Exception $e){
            dd("Error al guardar el postre emergente: ".$e->getMessage());
        }

        $pedido = new Pedido;
        $pedido->id_usuario = session('id_u');
        $pedido->id_tipopostre = $postre->id_tipo_postre;
        $pedido->id_seleccion_usuario = $emergente->id_pt;//este es el id de la tabla postre emergente que se guardara en pedido
        $pedido->porcionespedidas = session('cantidad_pedida');
        $pedido->fecha_hora_entrega = session('fecha') . " " . session('hora_entrega'); 
        $pedido->fecha_hora_registro = now();
        $pedido->status = "pendiente";
        $pedido->precio_final = $postre->precio_emergentes;
        
        try {
            $pedido->save();
        } catch (\Exception $e) {
            dd("Error al guardar el pedido: " . $e->getMessage());
        }
        
        //para reducir su stock en caso de que tenga si es null entonces no maneja stock
        if($postre->stock != null){
            $postre->stock = $postre->stock - session('cantidad_pedida');
            $postre->save();
        }

        session([
            'folio' => $pedido->id_ped,
        ]);

        return redirect()->route('emergente.ticket.get');   
    }

    public function seleccionarDireccion(Request $request){ 

        $ubicacion = $request->input('ubicacion');
        $id_usuario = $request->input('id_usuario');
        //por defecto cargamos la ubicacion del usuario predeterminado
        $user = usuario::where('id_u', $id_usuario)->first();
        $codigo_postal = $user->Codigo_postal_u;
        $estado = $user->estado_u;
        $ciudad = $user->ciudad_u;
        $colonia = $user->colonia_u;
        $calle = $user->calle_u;
        $numero = $user->num_exterior_u; ///<-----------AQUI SE TIENE QUE SEPARAR EN DOS CAMPOS
        //$referencia = $user->referencia_u;

        //si elige otra entocnes sobreescribimos los valores
        if($ubicacion=='otra'){
            $codigo_postal = $request->input('codigo_postal');
            $estado = $request->input('estado');
            $ciudad = $request->input('ciudad');
            $colonia = $request->input('colonia');
            $calle = $request->input('calle');
            $numero = $request->input('numero'); ///<-----------AQUI SE TIENE QUE SEPARAR EN DOS CAMPOS
            //$referencia = $request->input('referencia');

            //si elige volverla su ubicacion predeterminada entonces lo actualizamos en el perfil del usuario
            if($request->has('predeterminado')){
                $user->Codigo_postal_u = $codigo_postal;
                $user->estado_u = $estado;
                $user->ciudad_u = $ciudad;
                $user->colonia_u = $colonia;
                $user->calle_u = $calle;
                $user->num_exterior_u = $numero; ///<-----------AQUI SE TIENE QUE SEPARAR EN DOS CAMPOS
                //$user->referencia_u = $referencia;
                $user->save();
            }

        }

        //ESTO ES LA CONSULTA A PARTIR DEL ID QUE ME LLEGO DE LA VISTA ANTERIOR
        $postre = Cache::remember('postresession', 10, function () {
            return Catalogo::where('id_postre', session('postre'))
                            ->first();
        });
        
        $emergente = new Postreemergente;
        $emergente->id_postre_elegido = $postre->id_postre;
        try{
            $emergente->save();
        }catch(\Exception $e){
            dd("Error al guardar el postre emergente: ".$e->getMessage());
        }

        $pedido = new Pedido;
        $pedido->id_usuario = session('id_u');
        $pedido->id_tipopostre = $postre->id_tipo_postre;
        $pedido->id_seleccion_usuario = $emergente->id_pt;//este es el id de la tabla postre emergente que se guardara en pedido
        $pedido->estado_e = $estado;
        $pedido->Codigo_postal_e = $codigo_postal;
        $pedido->ciudad_e = $ciudad;
        $pedido->colonia_e = $colonia;
        $pedido->calle_e = $calle;
        $pedido->num_exterior_e = $numero; ///<-------------------AQUI SE TIENE QUEE SEPARAR EN DOS CAMPOS
        //$pedido->referencia_e = $referencia;
        $pedido->porcionespedidas = session('cantidad_pedida');
        $pedido->fecha_hora_entrega =  session('fecha') . " " . session('hora_entrega'); 
        $pedido->fecha_hora_registro = now();
        $pedido->status = "pendiente";
        $pedido->precio_final = $postre->precio_emergentes;;
        
        try {
            $pedido->save();
        } catch (\Exception $e) {
            dd("Error al guardar el pedido: " . $e->getMessage());
        }
        
        session([
            'folio' => $pedido->id_ped,
        ]);

        return redirect()->route('emergente.ticket.get');   

    }
}
