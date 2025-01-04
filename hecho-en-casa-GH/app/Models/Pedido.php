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

    protected $fillable = [
        'id_usuario',
        'id_tipopostre',
        'id_seleccion_usuario',
        'porcionespedidas',
        'estado_e',
        'Codigo_postal_e',
        'ciudad_e',
        'colonia_e',
        'calle_e',
        'num_exterior_e',
        'num_interior_e',
        'referencia_e',
        'status',       
        'precio_final',
        'fecha_hora_registro',
        'fecha_hora_entrega',
    ];


    public function pastelPersonalizado() {
        return $this->belongsTo(Pastelpersonalizado::class, 'id_seleccion_usuario');
    }
    
}
