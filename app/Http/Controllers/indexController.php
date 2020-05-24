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
class indexController extends Controller
{
    public function index(){
        $banner=Banner::where('estatus','si')->get();
        $plan=PlanAfilizacion::where('exposicion','Alta')->with('tienda')->get();
        

        
        $producto=Producto::where('status','si')->with('imagen')->get();

        $categoria=Categoria::with('subCategoria')->get();

        return view('plantilla.tiendaContenido.index',compact('producto'),compact('categoria','banner','tienda'));
    }
}
