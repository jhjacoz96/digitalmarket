<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoAtributo extends Model
{
    
    protected $fillable=[
        'nombre'
    ];

    public function Atributo(){
        return $this->hasMany('App\Atributo','grupoAtributo_id');
    }


}
