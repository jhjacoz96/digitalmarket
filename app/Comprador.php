<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comprador extends Model
{
    protected $fillable=[
        'nombre',
        'apellido',
        'correo',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
