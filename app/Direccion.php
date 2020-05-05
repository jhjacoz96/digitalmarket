<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $fillable=[
        'nombre',
        'apellido',
        'direccionExacta',
        'puntoReferencia',
        'primerTelefono',
        'segundoTelefono',
        'observacion',
        'comprador_id',
        'zona_id'
    ];


    public function comprador(){
        return $this->belongsTo('App\Comprador','comprador_id');
        
    }

    public function zona(){
        return $this->belongsTo('App\Zona','zona_id');
    }
}
