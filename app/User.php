<?php

namespace App;
use App\Rol;
use App\Comprador;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $fillable =[
        'nombre','apellidos','email','password','rol_id'
    ];

    protected $hidden =[
        'password','remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rol(){
        
        return $this->belongsTo('App\Rol');
        
    } 

   public function comprador()
   {
       return $this->hasOne('App\Comprador');
   }
}
