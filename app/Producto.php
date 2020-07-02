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
        'ventas',
        'sliderPrincipal',
        'peso',
        'sku',
        'tienda_id',
        'notificarStock'
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
       return $this->hasMany('App\Calificacion','producto_id');
    }

    public static function carritoCount(){
        if (\Auth::check()){ 
            $comprador=\Auth::user()->comprador;
           $carrito=\DB::table('carritos')->where('comprador_id', $comprador->id)->sum('cantidad');
        }
        else if(!empty(\Session::get('session_id'))){
            $session_id=\Session::get('session_id');
            $carrito=\DB::table('carritos')->where('session_id',$session_id)->sum('cantidad');
        }else {

            $carrito=0;
        }
        return $carrito;
    }

    public static function productoCount($id){
        $categoriaCount=Producto::where(['subCategoria_id'=>$id,'status'=>'si'])->count();
        return $categoriaCount;
    }

    public static function marcaCount($id){
        $marcaCount=Producto::where(['marca_id'=>$id,'status'=>'si'])->count();
        return  $marcaCount;
    }

    public static function obtenerMoneda($precio){
        
        $moneda=Divisa::where('status','A')->get();
        if($moneda!=''){

            $nombre=array();
            $monto=array();
            for ($i=0; $i <count($moneda) ; $i++) { 
                array_push($nombre,$moneda[$i]['codigo']);
                $valor=round($precio/$moneda[$i]['cambio'],2);
                array_push($monto,$valor);
            }
            $data=array("nombre"=>$nombre,"monto"=>$monto);
            return $data;
        }else{
            $data='';
        }
       
    }
    
    public static function generarSku($sub){
        $tiendaCodigo=\Auth::user()->tienda->codigo;
        $subCategoria=SubCategoria::where('nombre',$sub)->first();
        $subCategoriaId=strtoupper($subCategoria->id);
        $categoria=Categoria::find($subCategoria->categoria->id);
        $categoriaId=strtoupper($categoria->id);
        $numero=count(Producto::All()) + 1;

        $sku=$tiendaCodigo.'-'. 0 .$categoriaId.'-'. 0 . $subCategoriaId.'-'.'CM'.'-'.$numero;

        return $sku;
    }

    public static function generarSub($sub){
        $sub=SubCategoria::where('nombre',$sub)->first();
        $nombre=$sub->id;
        return $nombre;
    }

    public static function generarMarca($sub){
        $sub=Marca::where('nombre',$sub)->first();
        $nombre=$sub->id;
        return $nombre;
    }

    public static function generarDescuento($precio,$porcentaje){
        if($porcentaje>0){
            $descuento=($precio*$porcentaje)/100;
            $precioActual=$precio-$descuento;
            return $precioActual;
        }else{
            return $precio;
        }
       
    }

   

}
