<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function autoComplete(Request $request){

        $palabraBuscar=$request->get('palabraBuscar');

        $producto=Producto::where('nombre','like','%'.$palabraBuscar.'%')->orderBy('nombre')->get();

        $resultados=[];

        foreach ($producto as $prod) {
            
            $encontrarTexto=\stristr($prod->nombre,$palabraBuscar);
            $prod->encontrar=$encontrarTexto;

            $recortarPalabra=substr($encontrarTexto,0,\strlen($palabraBuscar));
            $prod->substr=$recortarPalabra;

            $prod->nameNegrita=str_ireplace($palabraBuscar,"<b>$recortarPalabra</b>",$prod->nombre);

            $resultados[]=$prod;


        }

        

        return $resultados;
    }
}
