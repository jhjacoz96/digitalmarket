<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Pedido;
use App\ProductoPedido;
use App\MetodoPagoPedido;
use App\MetodoPago;
use App\MedioEnvio;
use App\PagoTiendaPedido;
use App\PlanAfilizacion;

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
            $countPc=Pedido::where('status','cancelado')->count();
            $countPt=PagoTiendaPedido::with(['pedido'=>function($q){
                $q->where('status','enviadoComprador');
            }])->count();

            return view('home',compact('countEt','countPa','countPp','countEc','countCu','countPt','countPc'));
        }
        
        
        if(\Auth::user()->rol_id=='2'){
            $nowPedido=Pedido::whereHas('producto',function($q){
                $q->where('tienda_id',\Auth::user()->tienda->id);
            })->where('status','pagoAceptado')->count();
            
            $productoStock=Producto::where('tienda_id',\Auth::user()->tienda->id)->whereBetween('cantidad', [0,'notificarStock'])->count();

            $plan=PlanAfilizacion::where('estatus','A')->get();

            return view('home',compact('nowPedido', 'productoStock','plan'));
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
