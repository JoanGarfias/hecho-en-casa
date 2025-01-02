<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogo;

class ControladorCatalogo extends Controller
{
    public function mostrar($categoria = null){
        if($categoria === null){
            $catalogo = Catalogo::where('id_categoria', 1)->all();
            return $catalogo;
        }
        else{
            $catalogo = Catalogo::where('id_categoria', $categoria)->get();
            return $catalogo;
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
