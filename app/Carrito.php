<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $fillable=[
        'producto_id',
        'combinacion_id',
        'precio',
        'cantidad',
        'comprador_id',
        'session_id'
    ];

    
}
