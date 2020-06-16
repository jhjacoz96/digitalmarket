<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;
use App\SubCategoria;
use App\Banner;
use App\Imagen;
use App\PlanAfilizacion;
use App\Tienda;
use App\Marca;
class indexController extends Controller
{
    public function index(){
        $banner=Banner::where('estatus','si')->get();
        
        $tienda=Tienda::whereHas('planAfiliacion',function($tienda){
            $tienda->where('exposicion','Maxima');
        })->where('estatus','A')->get();
     
        $producto=Producto::whereHas('tienda',function($tienda){
            $tienda->whereHas('planAfiliacion',function($plan){
                $plan->where('exposicion','Maxima');
        });
        })->where('status','si')->with('imagen')->orderBy('ventas','desc')->get();

        $productoOferta=Producto::whereHas('tienda',function($tienda){
            $tienda->whereHas('planAfiliacion',function($plan){
                $plan->where('exposicion','Maxima');
        });
        })->with('imagen')->where('status','si')->where('porcentajeDescuento','!=',0)->get();

        $categoria=Categoria::with('subCategoria')->get();

        $marca=Marca::All();


       

        return view('plantilla.tiendaContenido.index',compact('categoria','banner','producto','marca','tienda','productoOferta'));
    }

    public function tienda($id){

        $producto=Producto::where('tienda_id',$id)->where('status','si')->with('imagen')->get();
        
        $tienda=Tienda::find($id);

        $categoria=Categoria::with('subCategoria')->get();

        $marca=Marca::All();

        return view('plantilla.tiendaContenido.tienda',compact('categoria','marca','producto','tienda'));

    }

}
