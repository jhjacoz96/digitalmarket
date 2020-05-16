<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $fillable=[
    
        'codigoCupon',
        'cantidad',
        'fechaExpiracion',   
        'estatus',
        'tipoCupon'
    ];

    

}
