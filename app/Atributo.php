<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atributo extends Model
{
    protected $fillable=[
        'nombre'
    ];


    public function grupoAtributo(){
        
            return $this->belongsTo('App\GrupoAtributo','grupoAtributo_id');
        
    }

    public function combinacion(){
        return $this->belongsToMany('App\Combinacion','atributo_combinacion','atributo_id','combinacion_id');
    }

}
