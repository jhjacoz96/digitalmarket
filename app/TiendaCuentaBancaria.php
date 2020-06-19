<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiendaCuentaBancaria extends Model
{

    protected $fillable =[
    'medioPago',
    'cuenta',
    'titular',
    'tipoCuenta',
    'tipodocumento',
    'documentoIndentidad',
    'telefono',
    'correo'
];

    public function tienda(){
       return $this->belongsTo('App\Tienda','tienda_id');
    }

    
}
