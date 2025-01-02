<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use Illuminate\Http\Request;

class ControladorCatalogoEmergente extends Controller
{
    public function mostrar(){
        $emergentes = [
            'temporada' => Catalogo::select('id_postre', 'imagen','id_tipo_postre')
                                    ->where('id_tipo_postre', 'temporada')
                                    ->where('disponible', '1')
                                    ->get(),

            'pop-up' =>    Catalogo::select('id_postre', 'imagen', 'id_tipo_postre', 'nombre', 'descripcion', 'stock')
                                    ->where('id_tipo_postre', 'pop-up')
                                    ->where('stock', '>', 0)
                                    ->get(),
        ];
        
        return response()->json($emergentes);
      
    }
}
