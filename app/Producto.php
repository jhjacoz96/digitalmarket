<?php

namespace App;
use App\Divisa;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    
    protected $fillable=[
        'nombre',
        'slug',
        'cantidad',
        'subCategoria_id',
        'precioAnterior',
        'precioActual',
        'porcentajeDescuento',
        'descripcionCorta',
        'descripcionLarga',
        'especificaciones',
        'datosInteres',
        'status',
        'tipoCliente',
        'marca_id',
        'visitas',
        'ventas'
    ];



    public function marca()
    {
        return $this->belongsTo('App\Marca','marca_id');
    }
    
    public function subCategoria()
    {
        return $this->belongsTo('App\SubCategoria','subCategoria_id');
    }

    public function imagen(){
        return $this->morphMany('App\Imagen','imageable');
    }

    public function combinacion(){
        return $this->hasMany('App\Combinacion','producto_id');
    }

    public function tienda(){
        return $this->belongsTo('App\Tienda','tienda_id');
    }

    public function pedido(){
      return  $this->belongsToMany('App\Pedido','pedido_producto','producto_id','pedido_id')->withPivot('precioProducto','combinacion_id','cantidadProducto','status','id');
    }

    public function calificacion(){
        $this->hasMany('App\Calificacion','producto_id');
    }

    public static function carritoCount(){
        if (\Auth::check()){ 
            $comprador=\Auth::user()->comprador;
           $carrito=\DB::table('carritos')->where('comprador_id', $comprador->id)->sum('cantidad');
        }else{
            $session_id=\Session::get('session_id');
            $carrito=\DB::table('carritos')->where('session_id',$session_id)->sum('cantidad');
        }
        return $carrito;
    }

    public static function productoCount($id){
        $categoriaCount=Producto::where(['subCategoria_id'=>$id])->count();
        return $categoriaCount;
    }

    public static function marcaCount($id){
        $marcaCount=Producto::where(['marca_id'=>$id])->count();
        return  $marcaCount;
    }

    public static function obtenerMoneda($precio){
        $moneda=Divisa::where('status','A')->get();
        foreach ($moneda as  $value) {
            if($value->codigo=='USD'){
                $usd=round($precio/$value->cambio,2);
            }
        }
        return $usd;
    }

   

}
