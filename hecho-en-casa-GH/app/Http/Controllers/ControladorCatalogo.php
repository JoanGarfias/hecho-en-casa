<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Catalogo;
use App\Models\Categoria;

class ControladorCatalogo extends Controller
{

    public function mostrar($categoria = null)
    {
        $categorias = Categoria::all();
    
        if ($categorias->isNotEmpty()) {
            if ($categoria === null) {
                $catalogo = Catalogo::select('id_postre', 'id_tipo_postre', 'id_categoria', 'imagen', 'nombre', 'descripcion')
                    ->where('id_tipo_postre', 'fijo')
                    ->where('id_categoria', 1)
                    ->get();
            }
            else {
                $catalogo = Catalogo::select('id_postre', 'id_tipo_postre', 'id_categoria', 'imagen', 'nombre', 'descripcion')
                    ->where('id_tipo_postre', 'fijo')
                    ->where('id_categoria', $categoria)
                    ->get();
            }
            if ($catalogo->isEmpty()) {
                abort(404, 'Catálogo no encontrado');
            }

            // Verificar si la solicitud es AJAX
            if (request()->ajax()) {
                return response()->json([
                    'categorias' => $categorias,
                    'catalogo' => $catalogo,
                    'categoriaSeleccionada' => $categoria
                ]);
            }
            else{
                // Si no es una solicitud AJAX, renderizar la vista normalmente
                return view('catalogo', compact('categorias', 'catalogo'))
                ->with('categoriaSeleccionada', $categoria);
            }
        }
        else {
            abort(500, 'Error interno del servidor');
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
