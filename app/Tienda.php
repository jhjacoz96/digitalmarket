<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    protected $fillable =[
            'nombre',
            'apellido',
            'nombreTienda',
            'correo',
            'telefono',
            'codigo',
            'direccion',
            'estatus',
            'user_id',
            'planAfilizacion_id'
    ];

    public function user()
    {
        return $this->hasOne('App\User','user_id');
    }

    public function planAfiliacion()
    {
        return $this->belongsTo('App\PlanAfilizacion','planAfilizacion_id');
    }
}
