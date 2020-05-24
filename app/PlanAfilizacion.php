<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanAfilizacion extends Model
{
    protected $fillable=[
        'nombre',
        'descripcion',
        'precio',
        'estatus',
        'exposicion',
        'tiempoPublicacion',
        'cantidadPublicacion'
        
    ];

    public function tienda()
    {
        return $this->hasMany('App\Tienda','planAfilizacion_id');
    }
}
