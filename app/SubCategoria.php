<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    protected $fillable=[
        'nombre',
        'descripcion',
        'slug'
    ];
    

    public function categoria(){
        
        return $this->belongsTo('App\Categoria');
        
    }

    public function producto()
    {
        return $this->hasMany('App\Producto','subCategoria_id');
    }



}
