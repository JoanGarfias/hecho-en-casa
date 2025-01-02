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
        $json_emergentes = json_encode($emergentes, JSON_PRETTY_PRINT);

        $popups = Catalogo::select('id_postre', 'imagen')
                                ->where('id_tipo_postre', 'pop-up')
                                ->where('stock', '>', 0)
                                ->get();

        $json_popups = json_encode($popups, JSON_PRETTY_PRINT);

        $data1 = json_decode($json_emergentes, true);
        $data2 = json_decode($json_popups, true);

        $union = array_merge($data1, $data2);

        return response()->json($union);
    }
}
