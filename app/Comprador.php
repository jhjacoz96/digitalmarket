<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comprador extends Model
{
    protected $fillable=[
        'nombre',
        'apellido',
        'correo',
        'user_id',
        'tipoComprador_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tipoComprador(){
        return $this->belongsTo('App\TipoComprador','tipoComprador_id');
    }
    public function direccion(){
        return $this->hasMany('App\Direccion','comprador_id');
    }
}
