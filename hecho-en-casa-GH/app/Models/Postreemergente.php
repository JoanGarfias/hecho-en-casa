<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postreemergente extends Model
{
    use HasFactory;
    protected $table = 'postreemergente';
    protected $primaryKey = 'id_pt'; // Indica que la clave primaria es id_pt
    public $incrementing = true;    // Es un campo con incremento automático
    protected $keyType = 'int'; 
    public $timestamps = false;
}
