<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $fillable=[
        'nombre',
        'codigoPostal'
    ];

    public function parroquia(){
       return $this->belongsTo('App\Parroquia','parroquia_id');
    }

    public function direccion(){
        return $this->hasMany('App\Direccion','zona_id');
    }
}
