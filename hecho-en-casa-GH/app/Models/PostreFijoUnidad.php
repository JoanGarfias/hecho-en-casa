<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostreFijoUnidad extends Model
{
    protected $table = 'postre_fijo_unidad_medidas';

    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class, 'id_um', 'id_um');
    }
}
