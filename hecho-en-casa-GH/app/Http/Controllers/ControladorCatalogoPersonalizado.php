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
Use Carbon\Carbon;

class ControladorCatalogoPersonalizado extends Controller
{
    public function mostrarCatalogo(){
        session([
            'id_tipopostre' => "personalizado"
        ]);

        return view("personalizados");
    }

    public function seleccionarCatalogo(){
        return redirect()->route('personalizado.calendario.get');
    }

    public function mostrarDetalles(){ //GET: Vista de detalles para personalizado
        $sabores = SaborPan::select('id_sp', 'nom_pan', 'precio_p')
        ->get();
        $rellenos = SaborRelleno::select('id_sr', 'nom_relleno', 'precio_sr')
        ->get();
        $coberturas = Cobertura::select('id_c', 'nom_cobertura', 'precio_c')
        ->get();
        $elementos = Elemento::select('id_e', 'nom_elemento', 'precio_e')
        ->get();
        
        return view('detallesPersonalizado', compact('sabores', 'rellenos', 'coberturas', 'elementos'));
    }

    public function seleccionarDetalles(Request $request){ //POST: Guardar las opciones de personalización

        $tematica = $request->input('tematica');
        $imagen = $request->input('imagen');
        $descripcion = $request->input('descripcion');
        $costo = intval($request->input('costo'));
        $tipo_entrega = $request->input('tipo_entrega');
        $id_usuario = 1;

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
        ];
        
        //return view('direccion', compact('datos'));

        if ($tipo_entrega === "Domicilio") {
            session([
                'sabor_pan' => $sabor_pan,
                'id_tipopostre' => $id_tipopostre,
                'relleno' => $relleno,
                'cobertura' => $cobertura,
                'elementos' => $elementos,
                'porciones' => $porciones,
                'tematica' => $tematica,
                'imagen' => $imagen,
                'descripcion' => $descripcion,
                'costo' => $costo,
                'tipo_entrega' => $tipo_entrega,
            ]);
            //return redirect()->route('personalizado.direccion.get'); 
            return view('direccion', compact('datos'));
        }
        else{

            $pastel = Pastelpersonalizado::create([
                'id_saborpan' => $sabor_pan,
                'id_saborrelleno' => $relleno,
                'id_cobertura' => $cobertura,
                'tipo_evento' => $tematica,
                'imagendescriptiva' => $imagen,
                'descripciondetallada' => $descripcion,
                'id_postre_elegido' => 37,
            ]);
            
            $id_detalles_pastel = $pastel->id_pp;

            $pedido = Pedido::create([
                'id_usuario' => $id_usuario,
                'id_seleccion_usuario' => $id_detalles_pastel,
                'id_tipopostre' => $id_tipopostre,
                'porcionespedidas' => $porciones,
                'status' => "pendiente",
                'precio_final' => $costo,
                'fecha_hora_registro' => $fecha_hora_registro,
                'fecha_hora_entrega' => $fecha_hora_entrega,
            ]);

            //return redirect()->route('personalizado.direccion.get'); 
            return view('direccion', compact('datos'));
        }
    }

    public function mostrarDireccion(){
        return view('direccion');
    }

    public function guardarDireccion(){

    }
}
