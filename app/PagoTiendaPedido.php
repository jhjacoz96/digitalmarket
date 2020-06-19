<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoTiendaPedido extends Model
{
    protected $fillable=[
        'moneda',
        'status',
        'montoPagado'
    ];

    public function tienda(){
        return $this->belongsTo('App\Tienda','tienda_id');
    }
    public function pedido(){
        return $this->belongsTo('App\Pedido','pedido_id');
    }

}
