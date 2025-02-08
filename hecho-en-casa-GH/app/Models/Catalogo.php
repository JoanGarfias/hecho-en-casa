<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    use HasFactory;
    protected $table = 'catalogo';
    public $timestamps = false;
    protected $primaryKey = 'id_postre';
    public $incrementing = true;    // Es un campo con incremento automático
    protected $keyType = 'int';
    protected $fillable = [
        'id_postre',
        'id_tipo_postre',
        'id_categoria',
        'imagen',
        'nombre',
        'descripcion',
        'stock',
        'disponible',
        'precio_emergentes',
        'id_receta'
    ];

}
