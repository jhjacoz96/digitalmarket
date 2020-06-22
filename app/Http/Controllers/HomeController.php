<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Pedido;
use App\ProductoPedido;
use App\MetodoPagoPedido;

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

        if(\Auth::user()->rol_id=='3'){

            $countEt=Pedido::where('status','esperaTransferencia')->count();
            $countPa=Pedido::where('status','pagoAceptado')->count();
            $countPp=Pedido::where('status','preparandoPedido')->count();
            $countEc=Pedido::where('status','enviadoComprador')->count();
            $countCu=Pedido::where('status','culminado')->count();

            return view('home',compact('countEt','countPa','countPp','countEc','countCu'));
        }
        
        
        if(\Auth::user()->rol_id=='2'){
            $nowPedido=Pedido::whereHas('producto',function($q){
                $q->where('tienda_id',\Auth::user()->tienda->id);
            })->where('status','pagoAceptado')->count();
            
            $productoStock=Producto::where('tienda_id',\Auth::user()->tienda->id)->whereBetween('cantidad', [0,'notificarStock'])->count();

            return view('home',compact('nowPedido', 'productoStock'));
        }
                
                
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
