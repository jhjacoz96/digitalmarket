<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodoPagoPedido extends Model
{
    protected $table = "metodo_pago_pedido";

    protected $fillable=[
        'cantidad',
        'status',
        'referencia'
        
    ];

}
