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

        $pedido = new Pedido;
        $tematica = $request->input('tematica');
        $imagen = $request->input('imagen');
        $descripcion = $request->input('descripcion');
        $costo = $request->input('costo');
        $tipo_entrega = $request->input('tipo_entrega');
        $id_usuario = 1;

        $fechaEscogida = session('fecha_entrega');
        $horaEntrega = session('hora_entrega');
        $fecha_hora_entrega = Carbon::parse($fechaEscogida . ' ' . $horaEntrega); 
        $fecha_hora_registro = now();


        $sabor_pan = $request->input('sabor_pan');
        $relleno = $request->input('sabor_relleno');
        $cobertura = $request->input('cobertura');
        $elementos = $request->input('elementos[]');
        $porciones = $request->input('porciones');


        if (strpos($tipo_entrega, 'domicilio') === true) {
            session([
                'sabor_pan' => $sabor_pan,
                'id_tipopostre' => "personalizado",
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
            return redirect()->route('personalizado.direccion.get'); 
        }
        else{
            $pedido = Pedido::create([
                'id_usuario' => $id_usuario,
                'id_tipopostre' => "personalizado",
                'porcionespedidas' => $porciones,
                'status' => "pendiente",
                'precio_final' => $costo,
                'fecha_hora_registro' => $fecha_hora_registro,
                'fecha_hora_entrega' => $fecha_hora_entrega,
            ]);

            $id_pedido = $pedido->id_ped;

            Pastelpersonalizado::create([
                'id_pp' => $id_pedido,
                'id_sabor_pan' => $sabor_pan,
                'id_saborrelleno' => $relleno,
                'id_cobertura' => $cobertura,
                'tipoevento' => $tematica,
                'imagendescriptiva' => $imagen,
                'descripciondetallada' => $descripcion,
                'id_postre_elegido' => 37,
            ]);
            return redirect()->route('personalizado.direccion.get'); 
        }
    }

    public function mostrarDireccion(){
        return view('direccion');
    }

    public function guardarDireccion(){

    }
}
