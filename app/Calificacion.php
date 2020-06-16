<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $fillable=[
        'titulo',
        'comentario',
        'calificacion'
    ];

    public function producto(){
        $this->belognsTo('App\Producto','producto_id');
    }

}
