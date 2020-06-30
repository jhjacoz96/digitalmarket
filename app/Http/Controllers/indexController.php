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
use App\Calificacion;
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

        })->where('status','si')->with('imagen')->orderBy('ventas','desc')->limit(6)->get();

        $productoOferta=Producto::whereHas('tienda',function($tienda){
            $tienda->whereHas('planAfiliacion',function($plan){
                $plan->where('exposicion','Maxima');
        });
        })->with('imagen')->where('status','si')->where('porcentajeDescuento','!=',0)->limit(6)->get();

        $categoria=Categoria::with('subCategoria')->get();

        $marca=Marca::All();


       

        return view('plantilla.tiendaContenido.index',compact('categoria','banner','producto','marca','tienda','productoOferta'));
    }

    public function tienda($id){

        $producto=Producto::where('tienda_id',$id)->where('status','si')->with('imagen')->paginate(12);
        
        $tienda=Tienda::find($id);
       
        $categoria=Categoria::with('subCategoria')->get();

        $marca=Marca::All();

        

        $countCalificacion=Calificacion::whereHas('producto',function($q) use($tienda){
            $q->where('tienda_id',$tienda->id);
        })->count();
        
        if($countCalificacion<=0){

            $promedio=0;
            $formatPromedio=0;
        }else{

            $sumaCalificacion=Calificacion::whereHas('producto',function($q) use($tienda){
                $q->where('tienda_id',$tienda->id);
            })->sum('calificacion');

            $promedio=$sumaCalificacion/$countCalificacion;
          
           $formatPromedio=number_format($promedio,0);
        }
   
        $star5=Calificacion::whereHas('producto',function($q) use($tienda){
            $q->where('tienda_id',$tienda->id);
        })->where('calificacion',5)->count();
        $star4=Calificacion::whereHas('producto',function($q) use($tienda){
            $q->where('tienda_id',$tienda->id);
        })->where('calificacion',4)->count();
        $star3=Calificacion::whereHas('producto',function($q) use($tienda){
            $q->where('tienda_id',$tienda->id);
        })->where('calificacion',3)->count();
        $star2=Calificacion::whereHas('producto',function($q) use($tienda){
            $q->where('tienda_id',$tienda->id);
        })->where('calificacion',2)->count();
        $star1=Calificacion::whereHas('producto',function($q) use($tienda){
            $q->where('tienda_id',$tienda->id);
        })->where('calificacion',1)->count();

        return view('plantilla.tiendaContenido.tienda',compact('categoria','marca','producto','tienda','sumaCalificacion','promedio','formatPromedio','countCalificacion','star5','star4','star3','star2','star1'));

    }

}
