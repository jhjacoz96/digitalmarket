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
        'status',
        'tipoCliente',
        'marca_id',
        'visitas',
        'ventas'
    ];


    public function subCategoria()
    {
        return $this->belongsTo('App\SubCategoria','subCategoria_id');
    }

    public function imagen(){
        return $this->morphMany('App\Imagen','imageable');
    }

    public function combinacion(){
        return $this->hasMany('App\Combinacion','producto_id');
    }
}
