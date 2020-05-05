<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BancoMetodoPago extends Model
{
    protected $fillable=[
        'nombreBanco',
        'titular',
        'detalleCuenta',
        'documentoIdentidad',
        'tipoCuenta'
    ];

    public function metodoPago(){
        return $this->belongsTo('App\MetodoPago','bancoMetodoPago_id');
    }
}
