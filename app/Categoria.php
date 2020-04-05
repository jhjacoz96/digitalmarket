<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable=[
        'nombre',
        'descripcion',
        'tipoLinea',
        'slug'
    ];
    

    public function subCategoria(){
        
        return $this->hasMany('App\SubCategoria');
        
    }

    
}
