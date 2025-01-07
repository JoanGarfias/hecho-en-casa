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
use App\Models\usuario;
Use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ControladorCatalogoPersonalizado extends Controller
{
    public function mostrarCatalogo(){
        session([
            'id_tipopostre' => "personalizado"
        ]);

        return view("personalizados");
    }

    public function seleccionarCatalogo(Request $request){
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('id_tipopostre', 'personalizado');
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        return redirect()->route('personalizado.calendario.get');
    }

    public function mostrarDetalles(){ //GET: Vista de detalles para personalizado
        $sabores = Cache::remember('sabores', 10, function () {
            return SaborPan::select('id_sp', 'nom_pan', 'precio_p')
            ->get();
        });
        $rellenos = Cache::remember('rellenos', 10, function () {
            return SaborRelleno::select('id_sr', 'nom_relleno', 'precio_sr')
            ->get();
        });
        $coberturas = Cache::remember('coberturas', 10, function () {
            return Cobertura::select('id_c', 'nom_cobertura', 'precio_c')
            ->get();
        });
        $elementos = Cache::remember('elementos', 10, function () {
            return Elemento::select('id_e', 'nom_elemento', 'precio_e')
            ->get();
        });
        
        return view('detallesPersonalizado', compact('sabores', 'rellenos', 'coberturas', 'elementos'));
    }

    public function seleccionarDetalles(Request $request){ //POST: Guardar las opciones de personalización

        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        $tipo_entrega = $request->input('tipo_entrega');
        session()->put('proceso_compra', $request->route()->getName());
        session()->put('opcion_envio', $tipo_entrega);
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        $tematica = $request->input('tematica');
        $imagen = $request->input('imagen');
        $descripcion = $request->input('descripcion');
        $costo = intval($request->input('costo'));
        $tipo_entrega = $request->input('tipo_entrega');
        $id_usuario = 1;

        session()->put('opcion_envio', $tipo_entrega);

        $fechaEscogida = session('fecha_entrega');
        $horaEntrega = session('hora_entrega');
        $fecha_hora_entrega = Carbon::parse($fechaEscogida . ' ' . $horaEntrega); 
        $fecha_hora_registro = now();
        $id_tipopostre = 'personalizado';

        $sabor_pan = intval($request->input('sabor_pan'));
        $relleno = intval($request->input('sabor_relleno'));
        $cobertura = intval($request->input('cobertura'));
        $elementos = array_map('intval', $request->input('elementos', []));
        
        $porciones = intval($request->input('porciones'));
        

        if ($tipo_entrega == "Domicilio") {
            $datos = [
                'id_saborpan' => $sabor_pan,
                'id_tipopostre' => $id_tipopostre,
                'id_saborrelleno' => $relleno,
                'id_cobertura' => $cobertura,
                'elementos' => $elementos,
                'porciones' => $porciones,
                'tematica' => $tematica,
                'imagen' => $imagen,
                'descripcion' => $descripcion,
                'costo' => $costo,
                'tipo_entrega' => $tipo_entrega,
                'fecha_hora_registro' => $fecha_hora_registro,
                'fecha_hora_entrega' => $fecha_hora_entrega
            ];
            session()->put('datos_pedido', $datos);


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
            $pastel->id_postre_elegido = 37;
            $pastel->save();  // Guardamos el pastel en la base de datos

            // Obtenemos el ID del pastel recién creado
            $id_detalles_pastel = $pastel->id_pp;

            // Instanciación de Pedido
            $pedido = new Pedido;
            $pedido->id_usuario = $id_usuario;
            $pedido->id_tipopostre = $id_tipopostre;
            $pedido->id_seleccion_usuario = $id_detalles_pastel;
            $pedido->porcionespedidas = $porciones;
            $pedido->status = 'pendiente';
            $pedido->precio_final = $costo;
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

            $datos = [
                'tematica' => $tematica,
                'imagen' => $imagen,
                'descripcion' => $descripcion,
                'costo' => $costo,
                'tipo_entrega' => $tipo_entrega,
                'id_usuario' => $id_usuario,
                'fecha_hora_entrega' => $fecha_hora_entrega,
                'fecha_hora_registro' => $fecha_hora_registro,
                'id_tipopostre' => $id_tipopostre,
                'sabor_pan' => $sabor_pan,
                'relleno' => $relleno,
                'cobertura' => $cobertura,
                'elementos' => $elementos,
                'porciones' => $porciones,
                'id_pp' => $id_detalles_pastel,
                'pedido' => [
                    'id_pedido' => $pedido->id_ped,
                    'porcionespedidas' => $pedido->porcionespedidas,
                    'status' => $pedido->status,
                    'precio_final' => $pedido->precio_final,
                    'fecha_hora_registro' => $pedido->fecha_hora_registro,
                    'fecha_hora_entrega' => $pedido->fecha_hora_entrega,
                ],
            ];
            return redirect()->route('personalizado.ticket.get', ['folio' => $id_pedido]);            
        }
    }

    public function mostrarDireccion(){
        $datos = session('datos_pedido');
        return view('direccionPersonalizado', compact('datos'));
    }

    public function guardarDireccion(Request $request){

        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */


        $tipo_domicilio = $request->input('tipo_domicilio');
        //dd($tipo_domicilio);
        //$datos = session('datos_pedido'); 
        
        $id_usuario = 1; //Prueba
        $user = usuario::where('id_u', $id_usuario)->first();
        $datos = session('datos_pedido'); 
        $codigo_postal = $user->Codigo_postal_u;
        $estado = $user->estado_u;
        $ciudad = $user->ciudad_u;
        $colonia = $user->colonia_u;
        $calle = $user->calle_u;
        $numero = $user->num_exterior_u;

        if($tipo_domicilio==="Nueva"){ //Datos prueba
            $codigo_postal = "77890";
            $estado = "Queretaro";
            $ciudad = "Palenque";
            $colonia = "Reforma 5";
            $calle = "Sin nombre";
            $numero = "1";
            //$referencia = $request->input('referencia');

            //Si elige volverla su ubicacion predeterminada entonces lo actualizamos en el perfil del usuario
            if($request->has("Default")){
                $user->Codigo_postal_u = $codigo_postal;
                $user->estado_u = $estado;
                $user->ciudad_u = $ciudad;
                $user->colonia_u = $colonia;
                $user->calle_u = $calle;
                $user->num_exterior_u = $numero;
                //$user->referencia_u = $referencia;
                $user->save();
            }

        }

        // Instanciación de Pastelpersonalizado
        $pastel = new Pastelpersonalizado;
        $pastel->id_saborpan = $datos['id_saborpan'];  // Accede usando el índice de array
        $pastel->id_saborrelleno = $datos['id_saborrelleno'];
        $pastel->id_cobertura = $datos['id_cobertura'];
        $pastel->tipo_evento = $datos['tematica'];
        $pastel->descripciondetallada = $datos['descripcion'];
        $pastel->id_postre_elegido = 37;
        $pastel->save();    // Guardamos el pastel en la base de datos

        
        // Obtenemos el ID del pastel recién creado
        $id_detalles_pastel = $pastel->id_pp;
        //$id_usuario = 1;

        // Instanciación de Pedido
        $pedido = new Pedido;
        $pedido->id_usuario = $id_usuario;
        $pedido->id_tipopostre = $datos['id_tipopostre'];
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
        $pedido->num_exterior_e = $numero; 
        $pedido->save();  // Guardamos el pedido en la base de datos

            $id_pedido = $pedido->id_ped;

        foreach($datos['elementos'] as $elem){
                $listarElemento = new ListaElementos;
                $listarElemento->id_pp = $id_detalles_pastel;
                $listarElemento->id_elemento = $elem;
                $listarElemento->save();
            }
            return redirect()->route('personalizado.ticket.get', ['folio' => $id_pedido]);  
    }

    public function mostrarTicket(Request $request, $folio = null){
        
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->forget('proceso_compra');
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        if ($folio !== null) {
            // Consulta el pedido con el folio
            $ticket_pedido = Pedido::select('id_ped','id_seleccion_usuario','id_tipopostre', 'porcionespedidas', 'status', 'precio_final')
            ->where('id_ped', $folio)
            ->first();
    
            if (!$ticket_pedido) {
                return redirect()->back()->with('error', 'El pedido con el folio especificado no existe.');
            }
    
            // Si hay una relación con Pastelpersonalizado
            $id_pastel = $ticket_pedido->id_seleccion_usuario;
            $datos = ["id_pastel" => $id_pastel];

            $ticket_pastel = Pastelpersonalizado::select('id_saborpan', 'id_saborrelleno', 'id_cobertura', 'tipo_evento', 'descripciondetallada', 'imagendescriptiva')
            ->where('id_pp', $id_pastel)
            ->first();
    
        }
        else {
            return redirect()->back()->with('error', 'El folio no fue especificado.');
        }
    
        // Envía la información a la vista
        return view('pedidoPersonalizado', compact('ticket_pedido', 'ticket_pastel', 'datos'));
    }
}
