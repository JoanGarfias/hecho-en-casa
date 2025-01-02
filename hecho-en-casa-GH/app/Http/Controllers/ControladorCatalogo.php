<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorCatalogo extends Controller
{
    public function mostrar($categoria = null){
        if($categoria === null){
            return "Estás viendo la categoria de Pays";
        }
        else{
            return "Seleccionaste la categoría {$categoria}";
        }
    }
}
