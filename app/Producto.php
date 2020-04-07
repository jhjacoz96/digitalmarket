<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    
    protected $fillable=[
        'nombre',
        'slug'
    ];


    public function subCategoria()
    {
        return $this->belongsTo('App\SubCategoria');
    }
}
