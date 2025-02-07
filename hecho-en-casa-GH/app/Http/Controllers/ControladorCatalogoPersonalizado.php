<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaborPan;
use App\Models\SaborRelleno;
use App\Models\Cobertura;
use App\Models\Elemento;
use App\Models\ListaElementos;
use App\Models\Pedido;
use App\Models\Pastelpersonalizado;
use App\Models\Catalogo;
Use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\usuario;
use Illuminate\Support\Facades\Cookie;

class ControladorCatalogoPersonalizado extends Controller
{
    public function mostrarCatalogo(Request $request){
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('id_tipopostre', 'personalizado');
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        return view("pasteles");
    }

    public function seleccionarCatalogo(Request $request){
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('id_tipopostre', 'personalizado');
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        return redirect()->route('personalizado.calendario.get');
    }

    public function mostrarDetalles(Request $request){ //GET: Vista de detalles para personalizado
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        
        $sabores = Cache::remember('sabores', 60, function () {
            return SaborPan::select('id_sp', 'nom_pan', 'precio_p')
            ->get();
        });
        $rellenos = Cache::remember('rellenos', 60, function () {
            return SaborRelleno::select('id_sr', 'nom_relleno', 'precio_sr')
            ->get();
        });
        $coberturas = Cache::remember('coberturas', 60, function () {
            return Cobertura::select('id_c', 'nom_cobertura', 'precio_c')
            ->get();
        });
        $elementos = Cache::remember('elementos', 60, function () {
            return Elemento::select('id_e', 'nom_elemento', 'precio_e')
            ->get();
        });
        
        $porciones_dia_aceptados = session('porciones_dia_aceptados'); 
        session()->put('porciones', 100 - $porciones_dia_aceptados);
        return view('pedidosPersonalizados', compact('sabores', 'rellenos', 'coberturas', 'elementos'));
    }

    public function seleccionarDetalles(Request $request){ //POST: Guardar las opciones de personalización

        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        $tipo_entrega = $request->input('tipoEntrega');
        session()->put('proceso_compra', $request->route()->getName());
        session()->put('opcion_envio', $tipo_entrega);
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        $tematica = $request->input('tematica');
        $imagen = $request->input('imagen');
        $descripcion = $request->input('descripcion');
        $costo = intval($request->input('costo'));
        $costototal = $request->input('costot');
        $porcionestotal = $request->input('porcionest');
        $id_usuario = session('id_usuario');
        //dd($porcionestotal);
        session(['costototal'=> $costototal, 'porcionestotal' => $porcionestotal]);
        
        session()->put('opcion_envio', $tipo_entrega);

        $fechaEscogida = session('fecha_entrega');
        $horaEntrega = session('hora_entrega');
        $fecha_hora_entrega = Carbon::parse($fechaEscogida . ' ' . $horaEntrega); 
        $fecha_hora_registro = now();
        $id_tipopostre = 'personalizado';

        $sabor_pan = intval($request->input('panElegido'));
        $relleno = intval($request->input('rellenoElegido'));
        $cobertura = intval($request->input('coberturaElegido'));
        $elementos = array_map('intval', $request->input('elementos', []));
        $costoCatalogo = Catalogo::where('id_tipo_postre', "personalizado")->first();; //LO SACARE DE A TABLA CATALOGO PRECIO_EMERGENTES
        $costoPan = SaborPan::where('id_sp', $sabor_pan)->first();
        $costoRelleno = SaborRelleno::where('id_sr', $relleno)->first();
        $costoCobertura = Cobertura::where('id_c', $cobertura)->first();

        $costo = $costoPan->precio_p + $costoRelleno->precio_sr + $costoCobertura->precio_c + $costoCatalogo->precio_emergentes;
        foreach ($elementos as $elementoId) {
            $costoElemento = Elemento::find($elementoId); 
            $costo += $costoElemento ? $costoElemento->precio : 0; 
        }

        //session()->put('costo', $costo);
        //$datos = ['costo', $costo];
        $porciones = intval($request->input('porciones'));
        
        if ($tipo_entrega == "Domicilio") {
            $datos = [
                'id_saborpan' => $sabor_pan,
                'id_tipopostre' => $id_tipopostre,
                'id_saborrelleno' => $relleno,
                'id_cobertura' => $cobertura,
                'elementos' => $elementos,
                'porciones' => $porcionestotal,
                'tematica' => $tematica,
                'imagen' => $imagen,
                'descripcion' => $descripcion,
                'costo' => $costototal,
                'tipo_entrega' => $tipo_entrega,
                'fecha_hora_registro' => $fecha_hora_registro,
                'fecha_hora_entrega' => $fecha_hora_entrega
            ];
            session()->put('datos_pedido', $datos);
            $usuario = usuario::where('id_u', $id_usuario)->first();

            $direccion = $usuario->calle_u . " " . $usuario->num_exterior_u . ", " . $usuario->colonia_u . ", " .
            $usuario->ciudad_u . ", ". $usuario->estado_u;
            session([
                'telefono' => $usuario->telefono,
                'direccion' => $direccion,
            ]);

            return redirect()->route('personalizado.direccion.get');            ;
        }
        else{
            // Instanciación de Pastelpersonalizado
            $pastel = new Pastelpersonalizado;
            $pastel->id_saborpan = $sabor_pan;
            $pastel->id_saborrelleno = $relleno;
            $pastel->id_cobertura = $cobertura;
            $pastel->tipo_evento = $tematica;
            $pastel->descripciondetallada = $descripcion;
            $pastel->imagendescriptiva = $imagen;
            $pastel->id_postre_elegido = 37; //id base del pastel personalizado
            $pastel->save();  // Guardamos el pastel en la base de datos

            // Obtenemos el ID del pastel recién creado
            $id_detalles_pastel = $pastel->id_pp;

            // Instanciación de Pedido
            $pedido = new Pedido;
            $pedido->id_usuario = $id_usuario;
            $pedido->id_tipopostre = 'personalizado';
            $pedido->id_seleccion_usuario = $id_detalles_pastel;
            $pedido->porcionespedidas = $porcionestotal;
            $pedido->status = 'pendiente';
            $pedido->precio_final = $costototal;
            $pedido->fecha_hora_registro = $fecha_hora_registro;
            $pedido->fecha_hora_entrega = $fecha_hora_entrega;
            $pedido->save();  // Guardamos el pedido en la base de datos

            $id_pedido = $pedido->id_ped;

            foreach($elementos as $elem){
                $listarElemento = new ListaElementos;
                $listarElemento->id_pp = $id_detalles_pastel;
                $listarElemento->id_elemento = $elem;
                $listarElemento->save();
            }
            session(['folio'=>$id_pedido]);
            return redirect()->route('personalizado.ticket.get');            
        }
    }

    public function mostrarDireccion(Request $request){
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        $rutaPost = "personalizado.direccion.post";
        $datos = session('datos_pedido');
        return view('ConfirmaDato', compact('datos', 'rutaPost'));
    }

    public function guardarDireccion(Request $request){
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */


        $tipo_domicilio = $request->input('ubicacion');
        
        $id_usuario = session('id_usuario');
        $user = Cache::remember('user', 10, function () use ($id_usuario){
            return usuario::where('id_u', $id_usuario)->first(); 
        });
        
        $datos = session('datos_pedido'); 
        $codigo_postal = $user->Codigo_postal_u;
        $estado = $user->estado_u;
        $ciudad = $user->ciudad_u;
        $colonia = $user->colonia_u;
        $calle = $user->calle_u;
        $numeroInterior = $user->num_interior_u;
        $numeroExterior = $user->num_exterior_u;
        $referencia = $user->referencia_u;

        if($tipo_domicilio==="otra"){ //Datos prueba
            $codigo_postal = $request->input('codigo_postal');
            $estado = $request->input('estado');
            $ciudad = $request->input('ciudad');
            $colonia = $request->input('asentamiento');
            $calle = $request->input('calle');
            $numeroInterior = $request->input('numeroI');
            $numeroExterior = $request->input('numeroE');
            $referencia = $request->input('referencia');

            //Si elige volverla su ubicacion predeterminada entonces lo actualizamos en el perfil del usuario
            if($request->has("opciones")){
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

        // Instanciación de Pastelpersonalizado
        $pastel = new Pastelpersonalizado;
        $pastel->id_saborpan = $datos['id_saborpan'];  // Accede usando el índice de array
        $pastel->id_saborrelleno = $datos['id_saborrelleno'];
        $pastel->id_cobertura = $datos['id_cobertura'];
        $pastel->tipo_evento = $datos['tematica'];
        $pastel->imagendescriptiva = $datos['imagen'];
        $pastel->descripciondetallada = $datos['descripcion'];
        $pastel->id_postre_elegido = 37;
        $pastel->save();  // Guardamos el pastel en la base de datos
        
        // Obtenemos el ID del pastel recién creado
        $id_detalles_pastel = $pastel->id_pp;

            // Instanciación de Pedido
        $pedido = new Pedido;
        $pedido->id_usuario = $id_usuario;
        $pedido->id_tipopostre = 'personalizado';
        $pedido->id_seleccion_usuario = $id_detalles_pastel;
        $pedido->porcionespedidas = $datos['porciones'];
        $pedido->status = 'pendiente';
        $pedido->precio_final = $datos['costo'];
        $pedido->fecha_hora_registro = $datos['fecha_hora_registro'];
        $pedido->fecha_hora_entrega = $datos['fecha_hora_entrega'];
        $pedido->estado_e = $estado;
        $pedido->Codigo_postal_e = $codigo_postal;
        $pedido->ciudad_e = $ciudad;
        $pedido->colonia_e = $colonia;
        $pedido->calle_e = $calle;
        $pedido->num_exterior_e = $numeroExterior;
        $pedido->num_interior_e = $numeroInterior; 
        $pedido->save();  // Guardamos el pedido en la base de datos

        $id_pedido = $pedido->id_ped;

        foreach($datos['elementos'] as $elem){
            $listarElemento = new ListaElementos;
            $listarElemento->id_pp = $id_detalles_pastel;
            $listarElemento->id_elemento = $elem;
            $listarElemento->save();
        }

        //$costo = session("costo");
        session(['folio'=>$id_pedido]);
        
        return redirect()->route('personalizado.ticket.get');  
    }

    public function mostrarTicket(Request $request){
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->forget('proceso_compra');
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        $folio = session('folio');
        
        if ($folio !== null) {
            // Consulta el pedido con el folio
            //Cache innecesario, por ser una consulta que se realiza una sola vez, y es improbable que se realice la misma consulta con un mismo folio dos veces seguidas
            $ticket_pedido = Pedido::where('id_ped', $folio)
            ->first();
    
            if (!$ticket_pedido) {
                return redirect()->route('personalizado.catalogo.get')->withErrors('errorFolio', 'El pedido con el folio especificado no existe.');
            }
            
            $entrega = $ticket_pedido->fecha_hora_entrega;
            list($fecha, $hora) = explode(' ', $entrega);
            // Si hay una relación con Pastelpersonalizado
            $id_pastel = $ticket_pedido->id_seleccion_usuario;
            
            //Cache innecesario, por ser una consulta que se realiza una sola vez, y es improbable que se realice la misma consulta con un mismo folio dos veces seguidas
            $ticket_pastel = Pastelpersonalizado::where('id_pp', $id_pastel)
                            ->first();
            
            $sabor_pan = SaborPan::where('id_sp', $ticket_pastel->id_saborpan)
                        ->first();
            $sabor_relleno = SaborRelleno::where('id_sr', $ticket_pastel->id_saborrelleno)
                        ->first();
            $sabor_cobertura = Cobertura::where('id_c', $ticket_pastel->id_cobertura)
                        ->first();

            $pan = $sabor_pan->nom_pan;
            $relleno = $sabor_relleno->nom_relleno;
            $tematica = $ticket_pastel->tipo_evento;
            $cobertura = $sabor_cobertura->nom_cobertura;
            $user = usuario::where('id_u', session('id_usuario'))->first();
            $nombre = $user->nombre;
            $telefono = $user->telefono;
            $tipo_entrega = session('opcion_envio');
            $link = $ticket_pastel->imagendescriptiva;
            $descripcion = $ticket_pastel->descripciondetallada;
            $costo = $ticket_pedido->precio_final;
        }   
        else {
            return redirect()->route('personalizado.catalogo.get')->withErrors('errorFolioNoEspecificado', 'El folio no fue especificado.');
        }
    
        // Envía la información a la vista
        return view('ResumenPedioP', compact('pan', 'relleno', 'cobertura',
            'tematica', 'nombre', 'telefono', 'tipo_entrega', 'link', 'descripcion',
            'costo', 'fecha', 'hora'));
    }
}
