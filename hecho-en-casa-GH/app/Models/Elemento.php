<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elemento extends Model
{
    use HasFactory;
    protected $table = 'elemento';
    public $timestamps = false;
    protected $primaryKey = 'id_e'; 
    public $incrementing = true; 

    protected $fillable = [
        'nom_elemento', 'precio_e'
    ];

}
