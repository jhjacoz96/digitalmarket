<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable =[
        'nombre'
        
];

public function producto(){
   return $this->hasMany('App\Producto','marca_id');
}

public function imagen(){
    return $this->morphOne('App\Imagen','imageable');
}

}
