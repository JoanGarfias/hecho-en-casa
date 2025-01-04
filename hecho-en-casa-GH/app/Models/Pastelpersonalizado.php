<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pastelpersonalizado extends Model
{
    use HasFactory;
    protected $table = 'pastelpersonalizado';
    public $timestamps = false;

    protected $fillable = [
        'id_saborpan',
        'id_saborrelleno',
        'id_cobertura',
        'tipo_evento',
        'imagendescriptiva',
        'descripciondetallada',
        'id_postre_elegido'
    ];

}
