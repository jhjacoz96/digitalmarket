<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable=[
        'montoTotal',
        'codigoCupon',
        'cantidadCupon',
        'status',
        'metodoEnvio_id',
        'direccion_id',
        'comprador_id',
        'factura_id'
    ];

    public function producto(){
      return  $this->belongsToMany('App\Producto','pedido_producto','pedido_id','producto_id')->withPivot('precioProducto','combinacion_id','cantidadProducto','status','id');
    }

    public function metodoPago(){
      return  $this->belongsToMany('App\MetodoPago','metodo_pago_pedido','pedido_id','metodoPago_id')->withPivot('cantidad','status','id','referencia','created_at','updated_at');
    }

    public function medioEnvio(){
      return  $this->belongsTo('App\MedioEnvio','metodoEnvio_id');
    }     

    public function comprador(){
      return  $this->belongsTo('App\Comprador','comprador_id');
    }

    public function direccionPedido(){
      return  $this->belongsTo('App\DireccionPedido','direccion_id');
    }

    public function direccionFactura(){
      return  $this->belongsTo('App\DireccionFactura','factura_id');
    }

    public function pagoTiendaPedido(){
      return $this->hasMany('App\PagoTiendaPedido','pedido_id');
    }

}
