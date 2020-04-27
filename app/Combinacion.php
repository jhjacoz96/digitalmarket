<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combinacion extends Model
{
    protected $fillable=[
        'cantidad'

    ];

    public function atributo(){
        return $this->belongsToMany('App\Atributo','atributo_combinacion','combinacion_id','atributo_id');
    }

    public function producto(){
        return $this->belongsTo('App\Producto','producto_id');
    }

}
