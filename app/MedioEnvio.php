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

    public function pedido(){
     return  $this->hasMany('App\Pedido','metodoEnvio_id');
    }

}
