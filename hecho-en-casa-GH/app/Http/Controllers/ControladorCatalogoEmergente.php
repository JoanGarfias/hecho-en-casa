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

    public function mostrar(Request $request){
    /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
    session()->put('id_tipopostre', 'emergente');
    session()->put('proceso_compra', $request->route()->getName());
    //No deberia estar aca pero jeyson no puso un POST para el catalogo
    /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        $emergentes = Cache::remember('catalogoemergentes', 30, function () {
            return [
                'temporada' => Catalogo::select('id_postre', 'imagen', 'id_tipo_postre')
                                    ->where('id_tipo_postre', 'temporada')
                                    ->where('disponible', '1')
                                    ->where('stock', '>', 0)
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
        return view('emergentes', compact('emergentes'));
    }

    public function guardarSeleccion(Request $request){
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        $idPostre = $request->input('id_postre');
        $postre = Cache::remember('postres', 30, function () use ($idPostre){
            return Catalogo::where('id_postre', $idPostre)->first();
        });

        
        $precio = $postre->precio_emergentes;

        session([
            'id_postre' => $idPostre,
            'id_tipopostre' => 'emergente',
            'precio' => $precio,
            'tipo_postre_e' => $postre->id_tipo_postre,
        ]);

        
        return redirect()->route('emergente.calendario.get');
    }

    public function seleccionar(Request $request){

        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        $validated = $request->validate([
            'id_postre' => 'required|integer',
        ]);

        session([
            'postre' => $validated['id_postre'],
        ]);

        return redirect()->route('emergente.detallesPedido.get');
    }

    public function mostrarDetalles(Request $request){
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        //ESTO ES LA CONSULTA A PARTIR DEL ID QUE ME LLEGO DE LA VISTA ANTERIOR
        $postre = Cache::remember('postresession', 10, function () {
            return Catalogo::where('id_postre', session('id_postre'))
                            ->first();
        });

        session([   
            'nombre_postre' => $postre->nombre,
            'sabor_postre' => $postre->nombre,
            'nombre_categoria' => $postre->id_tipo_postre,
            'tipo_postre_e' => $postre->id_tipo_postre
        ]);
        

        return view('pedidosTempPop');
    }

    public function seleccionarDetalles(Request $request){    
        
        $cantidad = $request->input('cantidad');
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        $tipo_entrega = $request->input('tipoEntrega');
        session()->put('opcion_envio', $tipo_entrega);
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        session([
            'cantidad_pedida' => $cantidad,
            'tipo_entrega' => $tipo_entrega,
            
        ]);

        $usuario = Cache::remember('usuario', 30, function () {
            return usuario::where('id_u', session('id_usuario'))->first();
        });

        $direccion = $usuario->calle_u . " " . $usuario->num_exterior_u . ", " . $usuario->colonia_u . ", " .
                    $usuario->ciudad_u . ", ". $usuario->estado_u;
        session([
            'telefono' => $usuario->telefono,
            'direccion' => $direccion,
        ]);

        $id_postre = session('id_postre');
        $postre = Cache::remember('postres2', 10, function () use ($id_postre){
            return Catalogo::where('id_postre', $id_postre)
                            ->first();
        });

        if(empty($postre) || ($postre->stock != null && $postre->stock < $cantidad)){
            return redirect()->route('inicio.get')
            ->withErrors('errorStock', 'Falta producto para completar su pedido'); 
        }

        $costo = $cantidad * $postre->precio_emergentes;
        session(['costo'=>$costo]);

        if($tipo_entrega === 'Domicilio'){
            return redirect()->route('emergente.direccion.get');  //SI SELECCIONO ENTREGA A DOMICILIO ENTONCES NOS VAMOS A DETALLES DIRECCION
        }

        $emergente = new Postreemergente;
        $emergente->id_postre_elegido = $postre->id_postre;
        try{
            $emergente->save();
        }catch(\Exception $e){
            return redirect()->route('inicio.get')
            ->withErrors('errorEmergente', 'Error al guardar el postre emergente.'); 
        }

        $pedido = new Pedido;
        $pedido->id_usuario = session('id_usuario');
        $pedido->id_tipopostre = $postre->id_tipo_postre;
        $pedido->id_seleccion_usuario = $emergente->id_pt;//este es el id de la tabla postre emergente que se guardara en pedido
        $pedido->porcionespedidas = session('cantidad_pedida');
        $pedido->fecha_hora_entrega = session('fecha_entrega') . " " . session('hora_entrega'); 
        $pedido->fecha_hora_registro = now();
        $pedido->status = "pendiente";
        $pedido->precio_final = $costo;
        
        try {
            $pedido->save();
        } catch (\Exception $e) {
            return redirect()->route('inicio.get')
            ->withErrors('errorPedido', 'Error al guardar el pedido'); 
        }
        
        //para reducir su stock en caso de que tenga si es null entonces no maneja stock
        if($postre->stock != null && $postre->stock > 0){
            $postre->stock = $postre->stock - session('cantidad_pedida');
            $postre->save();
        }

        session([
            'folio' => $pedido->id_ped,
        ]);

        return redirect()->route('emergente.ticket.get');   
    }

    public function mostrarDireccion(Request $request){
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        $rutaPost = "emergente.direccion.post";
        //$datos = session('datos_pedido');
        return view('confirmaDato', compact('rutaPost'));
    }

    public function seleccionarDireccion(Request $request){ 
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        $ubicacion = $request->input('ubicacion');

        //por defecto cargamos la ubicacion del usuario predeterminado
        $user = Cache::remember('usuario', 30, function () {
            return usuario::where('id_u', session('id_usuario'))->first();
        });
        $codigo_postal = $user->Codigo_postal_u;
        $estado = $user->estado_u;
        $ciudad = $user->ciudad_u;
        $colonia = $user->colonia_u;
        $calle = $user->calle_u;
        $numeroInterior = $user->num_interior_u;
        $numeroExterior = $user->num_exterior_u;
        $referencia = $user->referencia_u;

        //si elige otra entocnes sobreescribimos los valores
        if($ubicacion=='otra'){
            $codigo_postal = $request->input('codigo_postal');
            $estado = $request->input('estado');
            $ciudad = $request->input('ciudad');
            $colonia = $request->input('asentamiento');
            $calle = $request->input('calle');
            $numeroInterior = $request->input('numeroI');
            $numeroExterior = $request->input('numeroE');
            $referencia = $request->input('referencia');

            //si elige volverla su ubicacion predeterminada entonces lo actualizamos en el perfil del usuario
            if($request->has('opciones')){
                $user->Codigo_postal_u = $codigo_postal;
                $user->estado_u = $estado;
                $user->ciudad_u = $ciudad;
                $user->colonia_u = $colonia;
                $user->calle_u = $calle;
                $user->num_exterior_u = $numeroExterior;
                $user->num_interior_u = $numeroInterior;
                $user->referencia_u = $referencia;
                $user->save();
            }

        }

        //ESTO ES LA CONSULTA A PARTIR DEL ID QUE ME LLEGO DE LA VISTA ANTERIOR
        $postre = Cache::remember('postresession', 10, function () {
            return Catalogo::where('id_postre', session('id_postre'))
                            ->first();
        });
        
        $emergente = new Postreemergente;
        $emergente->id_postre_elegido = $postre->id_postre;
        try{
            $emergente->save();
        }catch(\Exception $e){
            return redirect()->route('inicio.get')
            ->withErrors('errorEmergente', 'Error al guardar el postre emergente.'); 
        }

        $pedido = new Pedido;
        $pedido->id_usuario = session('id_usuario');
        $pedido->id_tipopostre = $postre->id_tipo_postre;
        $pedido->id_seleccion_usuario = $emergente->id_pt;//este es el id de la tabla postre emergente que se guardara en pedido
        $pedido->estado_e = $estado;
        $pedido->Codigo_postal_e = $codigo_postal;
        $pedido->ciudad_e = $ciudad;
        $pedido->colonia_e = $colonia;
        $pedido->calle_e = $calle;
        $pedido->num_exterior_e = $numeroExterior; 
        $pedido->num_interior_e = $numeroInterior; 
        $pedido->referencia_e = $referencia;
        $pedido->porcionespedidas = session('cantidad_pedida');
        $pedido->fecha_hora_entrega =  session('fecha_entrega') . " " . session('hora_entrega'); 
        $pedido->fecha_hora_registro = now();
        $pedido->status = "pendiente";
        $pedido->precio_final = session('costo');
        
        try {
            $pedido->save();
        } catch (\Exception $e) {
            return redirect()->route('inicio.get')
            ->withErrors('errorPedido', 'Error al guardar el pedido.'); 
        }
        
        session([
            'folio' => $pedido->id_ped,
        ]);

        return redirect()->route('emergente.ticket.get');   

    }

    public function mostrarTicket(){
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->forget('proceso_compra');
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        $pedido = Pedido::find(session("folio"));
        $fechaHoraEntrega = $pedido->fecha_hora_entrega;
        $costo = $pedido->precio_final;

        list($fecha, $hora) = explode(' ', $fechaHoraEntrega);
        $usuario = Usuario::find($pedido->id_usuario); 
        
        $nombre = $usuario->nombre;
        $telefono = $usuario->telefono;
        
        $tipo_entrega = session('tipo_entrega');
        $tipo_postre = $pedido->id_tipopostre;

        return view('ResumenPedFij', compact('costo', 'nombre', 'telefono', 'fecha', 'hora', 'tipo_entrega', 'tipo_postre'));
    }
}
