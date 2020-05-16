<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;
use App\SubCategoria;
class indexController extends Controller
{
    public function index(){
        $producto=Producto::where('status','si')->with('imagen')->get();

        $categoria=Categoria::with('subCategoria')->get();

        return view('plantilla.tiendaContenido.index',compact('producto'),compact('categoria'));
    }
}
