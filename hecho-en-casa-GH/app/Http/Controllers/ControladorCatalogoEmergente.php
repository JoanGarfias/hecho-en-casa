<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use Illuminate\Http\Request;

class ControladorCatalogoEmergente extends Controller
{
    public function mostrar(){
        $emergentes = Catalogo::select('id_postre', 'imagen')
                                ->where('id_tipo_postre', 'temporada')
                                ->where('disponible', '1')
                                ->get();
        return response()->json($emergentes);
    }
}
