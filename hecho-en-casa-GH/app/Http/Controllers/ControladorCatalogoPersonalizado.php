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
        $ubicacion = $request->input('ubicacion');
        $id_usuario = session('id_u');
        $fecha_hora_entrega = $request->input('fecha_hora_entrega'); 
        $fecha_hora_registro = now();


        $sabor_pan = $request->input('sabor_pan');
        $relleno = $request->input('sabor_relleno');
        $cobertura = $request->input('cobertura');
        $elementos = $request->input('elementos');
        $porciones = $request->input('porciones');


        if($ubicacion === 'otra'){
            session([
                'sabor_pan' => $sabor_pan,
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
            Pedido::create([
                'id_usuario' => $id_usuario,
                'porcionespedidas' => $porciones,
                'status' => "pendiente",
                'precio_final' => $costo,
                'fecha_hora_registro' => $fecha_hora_registro,
                'fecha_hora_entrega' => $fecha_hora_entrega,
            ]);

            Pastelpersonalizado::create([
                'id_sabor_pan' => $sabor_pan,
                'id_saborrelleno' => $relleno,
                'id_cobertura' => $cobertura,
                'tipoevento' => $tematica,
                'imagendescriptiva' => $imagen,
                'descripciondetallada' => $descripcion,
            ]);
            
        }

    }
}
