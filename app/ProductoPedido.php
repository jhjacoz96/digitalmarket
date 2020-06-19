<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoPedido extends Model
{
    protected $table = "pedido_producto";

    protected $fillable=[
        'precioProducto',
        'combinacion_id',
        'cantidadProducto',
        'status',
        'id'
        
    ];

    
}
