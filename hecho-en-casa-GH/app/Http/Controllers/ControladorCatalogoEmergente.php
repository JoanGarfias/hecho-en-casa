<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use Illuminate\Http\Request;

class ControladorCatalogoEmergente extends Controller
{
    public function mostrar(){
        $emergentes = [
            //consulta para obtener todos los postres de temporada disponibles en el catalogo
            'temporada' => Catalogo::select('id_postre', 'imagen','id_tipo_postre')
                                    ->where('id_tipo_postre', 'temporada')
                                    ->where('disponible', '1')
                                    ->get(),
            //consulta para obtener todos los postres pop-up disponibles en el catalogo
            'pop-up' =>    Catalogo::select('id_postre', 'imagen', 'id_tipo_postre', 'nombre', 'descripcion', 'stock')
                                    ->where('id_tipo_postre', 'pop-up')
                                    ->where('stock', '>', 0)
                                    ->get(),
        ];
        
        return response()->json($emergentes);
      
    }

    public function mostrarDetalles(){
        //ESTO DEBERIA JALARSE DE LA VISTA ANTERIOR AQUI SOLO VA UN EJEMP
        session([
            'id_u' => "1",
            'fecha' => "2025-01-03",
            'postre' => "30",
            'cantidad_minima' => "4",
        ]);

        //ESTO ES LA CONSULTA A PARTIR DEL ID QUE ME LLEGO DE LA VISTA ANTERIOR
        $postre = Catalogo::where('id_postre', session('postre'))
                            ->first();

        session([   
            'nombre_postre' => $postre->nombre,
        ]);

        return view('detalles');
    }

    public function seleccionarDetalles(Request $request){
        $validated = $request->validate([
            'cantidad' => 'required|integer',
            'tipo_entrega' => 'required',
        ]);

        $tipo_entrega = $validated['tipo_entrega'];

        session([
            'cantidad_pedida' => $validated['cantidad'],
            'tipo_entrega' => $validated['tipo_entrega'],
        ]);

        if($tipo_entrega == 'domicilio'){
            return redirect()->route('pedido.direccion');
        }
        
        return redirect()->route('pedido.resumen');   
    }
}
