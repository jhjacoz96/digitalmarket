<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $fillable=[
        'nombre',
        'descripcion',
        'tipoPago',
        'moneda',
        'correo',
        'telefono'
        
    ];

    public function bancoMetodoPago(){
        return $this->belongsTo('App\BancoMetodoPago','bancoMetodoPago_id');
    }

    public function pedido(){
       return $this->belongsToMany('App\Pedido','metodo_pago_pedido','metodoPago_id','pedido_id')->withPivot('cantidad','status','id','referencia','created_at','updated_at');
    }

}
