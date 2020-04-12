<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    
    protected $fillable=[
        'nombre',
        'slug',
        'cantidad',
        'subCategoria_id',
        'precioAnterior',
        'precioActual',
        'porcentajeDescuento',
        'descripcionCorta',
        'descripcionLarga',
        'especificaciones',
        'datosInteres',
        'status'
    ];


    public function subCategoria()
    {
        return $this->belongsTo('App\SubCategoria','subCategoria_id');
    }

    public function imagen(){
        return $this->morphMany('App\Imagen','imageable');
    }
}
