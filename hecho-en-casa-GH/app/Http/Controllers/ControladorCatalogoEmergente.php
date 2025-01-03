<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ControladorCatalogoEmergente extends Controller
{
    public function mostrar(){

            $emergentes = Cache::remember('catalogoemergentes', 3600, function () {
                return [
                    'temporada' => Catalogo::select('id_postre', 'imagen', 'id_tipo_postre')
                                        ->where('id_tipo_postre', 'temporada')
                                        ->where('disponible', '1')
                                        ->get(),
    
                    'pop-up' => Catalogo::select('id_postre', 'imagen', 'id_tipo_postre', 'nombre', 'descripcion', 'stock')
                                        ->where('id_tipo_postre', 'pop-up')
                                        ->where('stock', '>', 0)
                                        ->get(),
                ];
            });
    
                if (!$emergentes) {
                    Log::info('Cache is empty or expired.');
                    return response()->json([]);
                }
        
                return response()->json($emergentes);
        
      
    }
}
