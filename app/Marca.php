<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable =[
        'nombre'
        
];

public function producto(){
    $this->hasMany('App\Producto','marca_id');
}

}
