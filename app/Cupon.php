<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $fillable=[
    
        'codigoCupon',
        'cantidad',
        'fechaExpiracion',   
        'estatus',
        'tipoCupon'
    ];


    public function tipoComprador(){
        return  $this->belongsToMany('App\TipoComprador','cupon_tipo_comprador','cupon_id','tipoComprador_id')->withPivot('created_at','updated_at');
      }
    

}
