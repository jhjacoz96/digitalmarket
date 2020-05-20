<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable=[
        'url',
        'titulo',
        'link',
        'estatus'
       
    ];
    
    public function imagen(){
        return $this->morphOne('App\Imagen','imageable');
    }
}
