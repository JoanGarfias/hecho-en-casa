<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postrefijo extends Model
{
    use HasFactory;
    protected $table = 'pedido';
    public $timestamps = false;
}
