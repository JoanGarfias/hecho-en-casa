<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postrefijo extends Model
{
    use HasFactory;
    protected $table = 'postrefijo';
    public $timestamps = false;
    protected $primaryKey = 'id_pf'; 
    public $incrementing = true; 

    protected $fillable = [
        'id_atributo', 'id_um', 'id_postre_elegido'
    ];

}
