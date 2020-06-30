<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Pedido;
use App\MetodoPago;
use App\MetodoPagoPedido;
use App\Tienda;
use App\Producto;
use App\PagoTiendaPedido;
use App\ProductoPedido;
use App\Notifications\pedidoNotification;


class pedidoController extends Controller
{
    public function pedido(){
    

        $pedido=Pedido::whereHas('producto',function($q){
            $q->where('tienda_id',\Auth::user()->tienda->id);
        })->with(['producto'=>function($q){
            $q->where('tienda_id',\Auth::user()->tienda->id);}])->where('status','!=','esperaTransferencia')->get();

        return view('plantilla.contenido.tienda.pedido.pedido',compact('pedido'));


    }


    public function detallePedido($id){
        
        $pedido=Pedido::with(['producto'=>function($q){
            $q->where('tienda_id',\Auth::user()->tienda->id);
            }])->with(['pagoTiendaPedido'=>function($e){
                $e->where('tienda_id',\Auth::user()->tienda->id);}])->findOrFail($id);
                
        $montoPedidotienda=0;
        
        foreach ($pedido->producto as $value) {
            $montoPedidotienda=$montoPedidotienda+($value->pivot->precioProducto*$value->pivot->cantidadProducto);
        }

        return view('plantilla.contenido.tienda.pedido.detalle',compact('pedido','montoPedidotienda'));

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
       
        if(empty($pago->referencia)){
            flash('Código de pago inválido')->warning()->important();
            
            return \redirect()->route('pedido.detalle',$pago->pedido_id);
        }
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

                $tiendas=[];
                foreach ($pedido->producto as $value) {

                    if(!in_array($value->tienda_id,$tiendas)){
                        
                        array_push($tiendas,$value->tienda_id);

                    }

                }
                
                

                foreach($tiendas as $id){

                    $t=Tienda::find($id);
                
                    $comment = 'nuevoPedido'; 
                    $t->notify(new pedidoNotification($comment,$pedido->id));

                
                    $pagoTiendaPedido= new PagoTiendaPedido();
        
                    $pedidoTienda=Pedido::with(['producto'=>function($q) use($t){
                        $q->where('tienda_id',$t['id']);}])
                    ->find($pedido->id);
                
                    $montoPedidotienda=0;
                    
                    foreach ($pedidoTienda->producto as $value) {
                        $montoPedidotienda=$montoPedidotienda+($value->pivot->precioProducto*$value->pivot->cantidadProducto);
                    }
                    
                   

                    $pagoTiendaPedido->montoPagado=$montoPedidotienda-(($t->planAfiliacion->precio/100)*$montoPedidotienda);
                    
                    $pagoTiendaPedido->tienda_id=$t->id;
                    $pagoTiendaPedido->moneda='indefinida';
                    $pagoTiendaPedido->pedido_id=$pedido->id;
                    $pagoTiendaPedido->status='espera';
                    $pagoTiendaPedido->save();





                }

                $comment = 'pagoAceptado'; 
                $pedido->comprador->notify(new pedidoNotification($comment,$pedido->id));


                $metodoPago=MetodoPago::findOrFail($pago->metodoPago_id);

                $comprador=$pedido->comprador;
                $correo=$pedido->comprador->correo;
                $datosMensaje=[
                    'metodoPago'=>$metodoPago,
                    'comprador'=>$comprador,
                    'pedido'=>$pedido,
                    'estado'=>$status
                ];
                
                Mail::send('correos.estadoPago',$datosMensaje,function($mensaje) use($correo){
                    $mensaje->to($correo)->subject('Estado de pago - DigitalMarket');
                });

            }else{

                $comment = 'metodoPagoAceptado'; 
                $pedido->comprador->notify(new pedidoNotification($comment,$pedido->id));

                $comprador=$pedido->comprador;
                $correo=$pedido->comprador->correo;
                $datosMensaje=[
                    'metodoPago'=>$metodoPago,
                    'comprador'=>$comprador,
                    'pedido'=>$pedido,
                    'estado'=>$status
                ];
                
                Mail::send('correos.estadoPago',$datosMensaje,function($mensaje) use($correo){
                    $mensaje->to($correo)->subject('Estado de pago - DigitalMarket');
                });

            }

            

            
            flash('El código de pago se ha  aceptada con exito')->success()->important();
            
            return \redirect()->route('pedido.detalle',$pago->pedido_id);
        }else{
            
            $pedido=Pedido::with('metodoPago')->findOrFail($pago->pedido_id);
            $metodoPago=MetodoPago::findOrFail($pago->metodoPago_id);

            $comprador=$pedido->comprador;
            $correo=$pedido->comprador->correo;
            $datosMensaje=[
                'metodoPago'=>$metodoPago,
                'comprador'=>$comprador,
                'pedido'=>$pedido,
                'estado'=>$status
            ];
            
            Mail::send('correos.estadoPago',$datosMensaje,function($mensaje) use($correo){
                $mensaje->to($correo)->subject('Estado de pago - DigitalMarket');
            });

            $pago->status='Denegado';
            $pago->save();

            $comment = 'metodoPagoDenegado'; 
            $pedido->comprador->notify(new pedidoNotification($comment,$pedido->id));

            flash('El código de pago se ha rechazado')->success()->important();

            return \redirect()->route('pedido.detalle',$pago->pedido_id);
        }
       
    }


    public function cambiarStatusPedido(Request $request,$id){

    if($request->ruta=='tiendaPedido'){
        $pedido=Pedido::with(['producto'=>function($q){
        $q->where('tienda_id',\Auth::user()->tienda->id);}])->findOrFail($id);
      
        foreach ($pedido->producto as $value) {
            $pedidoProducto=ProductoPedido::findOrFail($value->pivot->id);
            $pedidoProducto->status='enviadoAlmacen';
            $pedidoProducto->save();
        }

        $estadoCantidad=ProductoPedido::where('pedido_id',$id)->where('status','esperaPago')->count();

        /*if($estadoCantidad<=0){
          
            $pedido=Pedido::findOrFail($id);
            $pedido->status='preparandoPedido';
            $pedidoS->save();

        }*/
        
        flash('Una vez el cliente haya calificado el pedido, se le trasferirá el monto obtenido por el pedido:  ' . $pedido->id .' ')->success()->important();
        return redirect()->back();
    }
      
        $pedido=Pedido::findOrFail($id);
        
        if($request->referencia){
            $pedido->referenciaEnvio=$request->referencia;
           
        }
        
        
        $pedido->status=$request->estado;
        $pedido->save();
      
        
        $correo=$pedido->comprador->correo;

        $datosMensaje=[
            'correo'=>$correo,
            'nombre'=>$pedido->comprador->nombre,
            'pedido'=>$pedido
        ];

        Mail::send('correos.cambioEstado',$datosMensaje,function($mensaje) use($correo){
            $mensaje->to($correo)->subject('Estado de pedido - DigitalMarket');
        });

        
        if($pedido->status=='preparandoPedido'){
            
            $comment = 'preparandoPedido'; 
            $pedido->comprador->notify(new pedidoNotification($comment,$pedido->id));

        }

        if($pedido->status=='cancelado'){

            $comment = 'cancelado'; 
            $pedido->comprador->notify(new pedidoNotification($comment,$pedido->id));
        }

        if($pedido->status=='enviadoComprador'){
        
            $comment = 'enviadoComprador'; 
            $pedido->comprador->notify(new pedidoNotification($comment,$pedido->id));

        }

        if($pedido->status=='pagoAceptado'){


            $tiendas=[];
            foreach ($pedido->producto as $value) {
                if(!in_array($value->tienda_id,$tiendas)){  
                    array_push($tiendas,$value->tienda_id);
                }
            }
            
            foreach($tiendas as $id){
                $t=Tienda::find($id);
               
                $pagoTiendaPedido= new PagoTiendaPedido();
    
                $pedidoTienda=Pedido::with(['producto'=>function($q) use($t){
                    $q->where('tienda_id',$t['id']);}])
                ->find($pedido->id);
             
                $montoPedidotienda=0;
                
                foreach ($pedidoTienda->producto as $value) {
                    $montoPedidotienda=$montoPedidotienda+($value->pivot->precioProducto*$value->pivot->cantidadProducto);
                }
 

                $pagoTiendaPedido->montoPagado=$montoPedidotienda-(($t->planAfiliacion->precio/100)*$montoPedidotienda);
                
                $pagoTiendaPedido->tienda_id=$t->id;
                $pagoTiendaPedido->moneda='indefinida';
                $pagoTiendaPedido->pedido_id=$pedido->id;
                $pagoTiendaPedido->status='espera';
                $pagoTiendaPedido->save();
               


                $comment = 'nuevoPedido'; 
                $t->notify(new pedidoNotification($comment,$pedido->id));
            }
            
           $comment = 'pagoAceptado'; 
            $pedido->comprador->notify(new pedidoNotification($comment,$pedido->id));

        }

        flash('El estado del pedido ha sido modificado con exito')->success()->important();
        return redirect('/pedido/detalle/'.$pedido->id);


    }

    public function verFactura($id){
        $pedido=Pedido::with('producto')->with('metodoPago')->where('id',$id)->first();
        $comprador=$pedido->comprador;
        return view('pdf.factura',compact('pedido','comprador'));
    }
    
    public function pdfFactura($id){
        $pedido=Pedido::with('producto')->with('metodoPago')->where('id',$id)->first();
        $comprador=$pedido->comprador;
        $pdf = \PDF::loadView('pdf.factura',compact('pedido','comprador'));
        return $pdf->stream('Fatura.pdf');
   }


   public function cambiarEstadoAlmacen($id){
        $productoPedido=ProductoPedido::findOrFail($id);
        
        $productoPedido->status='listoEnviar';
        
        $productoPedido->save();
        $estadoCantidad=ProductoPedido::where('pedido_id', $productoPedido->pedido_id)->where('status','!=','listoEnviar')->count();
        
        if($estadoCantidad<=0){
            $pedido=Pedido::find($productoPedido->pedido_id);
            $pedido->status='preparandoPedido';
            $pedido->save();

        }

        flash('Este producto ya se encuentra listo para el envio')->success()->important();
        return redirect()->back();
   }

   
}
