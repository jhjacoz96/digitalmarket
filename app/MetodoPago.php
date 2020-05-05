<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $fillable=[
        'nombre',
        'descripcion',
        'tipoPago',
        'moneda',
        'correo',
        'telefono'
        
    ];

    public function bancoMetodoPago(){
        return $this->belongsTo('App\BancoMetodoPago');
    }
}
