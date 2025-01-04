<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pastelpersonalizado extends Model
{
    use HasFactory;
    protected $table = 'pastelpersonalizado'; 
    protected $primaryKey = 'id_pp'; 
    public $incrementing = true; 
    protected $keyType = 'int';   
    public $timestamps = false;  

    protected $fillable = [
        'id_saborpan', 'id_saborrelleno', 'id_cobertura', 'tipo_evento',
        'descripciondetallada', 'id_postre_elegido'
    ];

    protected $guarded = ['id_pp']; 

    public function pedido() {
        return $this->hasMany(Pedido::class, 'id_seleccion_usuario');
    }
    

}
