<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    // Define la tabla y la clave primaria
    protected $table = 'usuario';
    protected $primaryKey = 'id_u'; // Cambia la clave primaria si es necesario

    // Desactiva el manejo de timestamps
    public $timestamps = false;

    // Define qué columnas deben ser ocultadas en las respuestas JSON
    protected $hidden = [
        'contraseña',
        'token_sesion',
        'token_recuperacion',
    ];

    // Define qué columnas pueden ser asignadas masivamente
    protected $fillable = [
        'token_sesion', // Añadir a fillable
        'token_recuperacion',
        'contraseña',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'correo_electronico',
        'telefono',
        'Codigo_postal_u',
        'estado_u',
        'ciudad_u',
        'colonia_u',
        'calle_u',
        'num_exterior_u',
        'num_interior_u',
        'referencia_u',
    ];

    // Definir los castings para columnas específicas (si es necesario)
    protected $casts = [
        'contraseña' => 'hashed', // Cambia el nombre del campo si es diferente
    ];
}
