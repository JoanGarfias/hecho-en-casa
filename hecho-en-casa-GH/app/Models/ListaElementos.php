<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListaElementos extends Model
{
    public $timestamps = false; // Desactiva created_at y updated_at
    protected $table = 'listaelementos';
}
