<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DireccionPedido extends Model
{

    protected $fillable=[
        'nombre',
        'apellido',
        'direccionExacta',
        'puntoReferencia',
        'primerTelefono',
        'segundoTelefono',
        'observacion',
        'zona',
        'parroquia',
        'municipio',
        'estado'
    ];

   

    public function pedido(){
        return $this->hasOne('App\Pedido','direccion_id');
    }
}
