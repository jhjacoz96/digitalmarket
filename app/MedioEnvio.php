<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedioEnvio extends Model
{
    protected $fillable=[
        'nombre',
        'tiempoEntrega',
        'precioEnvio',
        'envioGratis',
        'status',
    ];
}
