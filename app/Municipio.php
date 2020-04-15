<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $fillable=[
        'nombre'
    ];

    public function estado()
    {
        return $this->belongsTo('App\Estado');
    }

    public function parroquia()
    {
        return $this->hasMany('App\Parroquia','minicipio_id');
    }
}
