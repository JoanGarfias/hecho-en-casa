<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaborPan;
use App\Models\SaborRelleno;
use App\Models\Cobertura;
use App\Models\Elemento;
use App\Models\ListaElementos;
use App\Models\Pastelpersonalizado;

class ControladorCatalogoPersonalizado extends Controller
{
    public function mostrarCatalogo(){
        session([
            'id_tipopostre' => "personalizado"
        ]);

        return view("personalizados");
    }

    public function mostrarDetalles(){ //GET: Vista de detalles para personalizado
        $sabores = SaborPan::select('id_sp', 'nom_pan', 'precio_p')
        ->get();
        $rellenos = SaborRelleno::select('id_sr', 'nom_relleno', 'precio_sr')
        ->get();
        $coberturas = Cobertura::select('id_c', 'nom_cobertura', 'precio_c')
        ->get();
        $elementos = Elemento::select('id_e', 'nom_elemento', 'precio')
        ->get();
        
        return view('detallesPersonalizado', compact('sabores', 'rellenos', 'coberturas', 'elementos'));
    }

    public function seleccionarDetalles(Request $request){ //POST: Guardar las opciones de personalización
        $sabor_pan = $request->input('sabor_pan');
        $relleno = $request->input('sabor_relleno');
        $cobertura = $request->input('cobertura');
        $elementos = $request->input('elementos');
        $porciones = $request->input('porciones');
        $tematica = $request->input('tematica');
        $imagen = $request->input('imagen');
        $descripcion = $request->input('descripcion');
        $costo = $request->input('costo');
        $tipo_entrega = $request->input('tipo_entrega');
        $ubicacion = $request->input('ubicacion');

        if($ubicacion === 'otra'){
            Pastelpersonalizado::create([
                'id_sabor_pan' => $sabor_pan,
                'id_saborrelleno' => $relleno,
                'id_cobertura' => $cobertura,
                'tipoevento' => $tematica,
                'imagendescriptiva' => $imagen,
                'descripciondetallada' => $descripcion,
            ]);
            
            return redirect()->route('resumen.pedido.get');
        }
        else{
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

    }
}
