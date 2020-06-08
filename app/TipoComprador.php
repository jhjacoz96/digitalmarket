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

    public function cupon(){
        return  $this->belongsToMany('App\Cupon','cupon_tipo_comprador','tipoComprador_id','cupon_id')->withPivot('created_at','updated_at');
    }


}
