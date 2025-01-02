<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Catalogo;
use App\Models\Categoria;

class ControladorCatalogo extends Controller
{

    public function obtenerCategorias(){
        $categorias = Categoria::all();
        if($categorias->isNotEmpty()){
            return response()->json($categorias);
        }
        else{
            abort(500, 'Error interno del servidor');
        }
    }

    public function mostrar($categoria = null){
        if($categoria === null){
            $catalogo = Catalogo::select('id_postre', 'id_tipo_postre', 'id_categoria', 'imagen', 'nombre', 'descripcion')
            ->where('id_tipo_postre', 'fijo')
            ->where('id_categoria', 1)
            ->get();


            // Verificar si el catálogo está vacío
            if ($catalogo->isEmpty()) {
                abort(404, 'Catálogo no encontrado'); // Lanzar error 404
            }
            else{
                return response()->json($catalogo);
            }
        }
        else{
            $catalogo = Catalogo::select('id_postre', 'id_tipo_postre', 'id_categoria', 'imagen', 'nombre', 'descripcion')
            ->where('id_tipo_postre', 'fijo')
            ->where('id_categoria', $categoria)
            ->get();

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
