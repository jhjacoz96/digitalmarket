<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use App\Pedido;
use App\MetodoPago;
use App\MetodoPagoPedido;
use App\Tienda;
use App\Producto;

class pedidoController extends Controller
{
    public function pedido(){
    

            $pedido=Pedido::whereHas('producto',function($q){
                $q->where('tienda_id',\Auth::user()->tienda->id);
            })->with(['producto'=>function($q){
                $q->where('tienda_id',\Auth::user()->tienda->id);}])->where('status','pagoAceptado')->get();
    
            return view('plantilla.contenido.tienda.pedido.pedido',compact('pedido'));


    }


    public function detallePedido($id){
        
        $pedido=Pedido::with(['producto'=>function($q){
            $q->where('tienda_id',\Auth::user()->tienda->id);}])->findOrFail($id);
       

        return view('plantilla.contenido.tienda.pedido.detalle',compact('pedido'));

    }



    public function pedidoAdmin($tipo){
        
        $pedido=Pedido::where('status',$tipo)->with('producto')->get();
 
        return view('plantilla.contenido.admin.pedido.consultar',compact('pedido'));

    }

    public function detallePedidoAdmin($id){
        $pedido=Pedido::with('producto')->with('metodoPago')->findOrFail($id);
        
        return view('plantilla.contenido.admin.pedido.detalle',compact('pedido'));
    }

    public function cambiarStatusPago($id,$status){
        $pago=MetodoPagoPedido::findOrFail($id);
        if($status=='aceptado'){
            $pago->status='Aceptado';
            $pago->save();

            $pedido=Pedido::with('metodoPago')->findOrFail($pago->pedido_id);
            $count=count($pedido->metodoPago);
            $valor=[];
            foreach ($pedido->metodoPago as  $value) {
                if($value->pivot->status=='Aceptado'){

                    array_push($valor,$value->pivot->status);
                }
            }
            $f=count($valor);  
            if($count===$f){
        
                $pedido->status='pagoAceptado';
                $pedido->save();
            }  
            
            flash('La referencia de este metodo de pago ha aceptada')->success()->important();
            
            return \redirect()->route('pedido.detalle',$pago->pedido_id);
        }else{
            $pago->status='Denegado';
            $pago->save();
            flash('La referencia del metodo de pago ha sido rechazada')->success()->important();

            return \redirect()->route('pedido.detalle',$pago->pedido_id);
        }
       
    }


    public function cambiarStatusPedido(Request $request,$id){

    if($request->ruta=='tiendaPedido'){
        $pedido=Pedido::with(['producto'=>function($q){
        $q->where('tienda_id',\Auth::user()->tienda->id);}])->findOrFail($id);

        foreach ($pedido->producto as $key => $value) {
            
        }

    }

        $pedido=Pedido::findOrFail($id);
        $pedido->status=$request->estado;
        $pedido->save();
        flash('El estado del pedido ha sido modificado con exito')->success()->important();
        return redirect('/pedido/detalle/'.$pedido->id);
    }
    


   
}
