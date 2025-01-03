<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedido';
    protected $primaryKey = 'id_ped';
    public $incrementing = true;    // Es un campo con incremento automático
    protected $keyType = 'int'; 
    public $timestamps = false;
}
