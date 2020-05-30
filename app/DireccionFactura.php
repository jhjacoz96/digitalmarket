<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DireccionFactura extends Model
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
        return $this->hasOne('App\direccionFactura','factura_id');
    }
}
