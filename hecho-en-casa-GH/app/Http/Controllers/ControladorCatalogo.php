<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogo;

class ControladorCatalogo extends Controller
{
    public function mostrar($categoria = null){
        if($categoria === null){
            
        }
        else{
            return "Seleccionaste la categoría {$categoria}";
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
