<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogo;

class ControladorCatalogo extends Controller
{
    public function mostrar($categoria = null){
        if($categoria === null){
            $catalogo = Catalogo::where('id_categoria', $categoria ?? 1)->get();

            // Verificar si el catálogo está vacío
            if ($catalogo->isEmpty()) {
                abort(404, 'Catálogo no encontrado'); // Lanzar error 404
            }
            else{
                return response()->json($catalogo);
            }
        }
        else{
            $catalogo = Catalogo::where('id_categoria', $categoria)->get();

            // Verificar si el catálogo está vacío
            if ($catalogo->isEmpty()) {
                abort(404, 'Catálogo no encontrado'); // Lanzar error 404
            }
            else{
                return response()->json($catalogo);
            }
        }
    }

    public function mostrarFecha(){
        
    }

    public function seleccionarFecha(){

    }

    public function mostrarDetalles(){

    }

    public function seleccionarDetalles(){

    }

    public function mostrarDetallesEntrega(){

    }

    public function seleccionarDetallesEntrega(){

    }

    public function mostrarTicket(){

    }
}
