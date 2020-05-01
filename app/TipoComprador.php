<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoComprador extends Model
{
    protected $fillable=[
        'nombre',
        'porcentajeDescuento',
        'estatus',
        'mostrarPrecio',
        'envioGratis'
    ];
    
    public function comprador(){
        return $this->hasMany('App\Comprador','tipoComprador_id');
    }
}
