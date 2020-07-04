@extends('layouts.frondTienda.design')
@section('style')    
<style>
#form {
  width: 250px;
  margin: 0 auto;
  height: 50px;
}

#form p {
  text-align: center;
}

#form label {
  font-size: 20px;
}

p.clasificacion {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

p.clasificacion input {
  position: absolute;
  top: -100px;
}

p.clasificacion label {
  float: right;
  color: aliceblue;
}

p.clasificacion label:hover,
p.clasificacion label:hover ~ label,
p.clasificacion input:checked ~ label {
  color: orange;
}




</style>
@endsection
@section('contenido')

@php
    use App\Producto;
    use App\Combinacion;
    use App\DireccionPedido;
    use App\DireccionFactura;
@endphp

<section id="cart_items">
    <div class="container">
        <div class="p-2">
            @include('flash::message')
        </div>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
            <li><a href="{{url('/pedidos')}}">Pedido</a></li>
            <li class="active">{{$pedido->id}}</li>
            
            </ol>
        </div> 
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading" >
           <div class="mb-4">
               <h4>Detalles del pedido</h4>
           </div>

            <div class="card bg-light mb-4" >
                
                <div class="card-body">
                    <span>
                    <h5 class="card-title">Referencia de pedido {{$pedido->id}} - efectuado el {{($pedido->created_at)->format('d-m-Y')}}</h5>
                   
                    </span>
                </div>
              </div>
        

              <div class="panel panel-primary mb-4 " >
                  <div class="panel-heading">
                      <span>
                      <h5 class="card-title">Medios de pago</h5>
                      </span>
                  </div>
                  <div class="panel-body">

                      <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Medio de pago</th>
                                <th>Tipo de medio de pago</th>
                                <th>Moneda</th>
                                <th>Referencia</th>
                                <th>Estado</th>
                                <th>Total a pagar</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedido->metodoPago as $item)
                        <form action="{{url('/comprador/referenciaPago/'.$item->pivot->id)}}" method="POST" >
                            @csrf
                            @method('PUT')
                                    <tr>
                                        <td>{{$item->nombre}}</td>
                                        <td>{{$item->tipoPago}}</td>
                                        <td>
                                            {{$item->moneda}}
                                        </td>
                                        <td>
                                           
                                        <input class="form-control"
                                        @if( $item->pivot->status=='Confirmación')
                                       
                                        disabled
                                        
                                        @endif
                                        @if( $pedido->status!='esperaTransferencia')
                                       
                                        disabled
                                        
                                        @endif
                                        value="{{$item->pivot->referencia}}" type="text" name="referencia">

                                        </td>
                                        <td>
                                            @if($item->pivot->status==='espera')
                                                Espera
                                            @else
                                                {{$item->pivot->status}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->moneda=='Bolivares')    
                                            Bs {{$item->pivot->cantidad}}
                                            @else
                                            $ {{$item->pivot->cantidad}}
                                            @endif
                                        </td>
                                        <td>
                                          @if($pedido->status=='esperaTransferencia')
                                          @if($item->pivot->status=='espera' ||$item->pivot->status=='Denegado')
                                          <button type="submit" onclick="return confirm('Antes de enviar la referencia, por favor verifíquela.')" class="btn btn-default">Actualizar</button>
                                          @endif

                                         

                                            @endif

                                        </td>
                                    </tr>
                                </form>

                            @endforeach

                        </tbody>
                     
                    </table>

                  </div>
                </div>

                <div class="panel panel-primary mb-4 " >
                    <div class="panel-heading">
                        <h5 class="card-title">Siga paso a paso el estado de su pedido</h5>
                    </div>
                    <div class="panel-body">
                       
                        <div class="form-group ">
                            <dl class="row">

                                @if($pedido->status!='esperaTransferencia')
                                <dt class="col-sm-4">Factura</dt>
                                <dd class="col-sm-8"><p><a href="{{url('/pedido-factura/'.$pedido->id)}}" class="btn btn-info"><i class="fa fa-file-invoice"></i> Generar factura</a></p></dd>
                                @endif

                            <dt class="col-sm-4">Fecha de creación</dt>
                            <dd class="col-sm-8">{{($pedido->created_at)->format('d-m-Y')}}</dd>
                           
                            <dt class="col-sm-4">Estado</dt>
                            <dd class="col-sm-8">
                                
                                @if($pedido->status=='esperaTransferencia')
                                <span class="label label-primary" >Espera por transferencia</span>
                                @endif

                                @if($pedido->status=='pagoAceptado')
                                <span class="label label-success">Pago aceptado</span>
                                @endif

                                @if($pedido->status=='enviadoComprador')
                                <span class="label" style="background-color:deeppink; color: floralwhite;">Enviado al comprador</span>
                                @endif

                                @if($pedido->status=='cancelado')
                                <span class="label label-danger">Pedido cancelado</span>
                                @endif

                                @if($pedido->status=='preparandoPedido')
                                <span class="label label-warning">Preparando pedido</span>
                                @endif
                                
                                @if($pedido->status=='culminado')
                                <span class="badge" style="background-color:darkorchid; color: floralwhite;">Culminado</span>
                                @endif

                            </dd>
                                
                            </dl>
                        </div>
                    </div>
                </div>
                
     
                 <div class="row">
                     <div class=" col-sm-5">
      
                         <div class="panel panel-primary mr-4 mb-4 " >
                             <div class="panel-body">
                                 <h6 class="card-title">Dirección de entrega </h6>
                                 @php
                                     $direccionPedido=DireccionPedido::where('id',$pedido->direccion_id)->first();
                                 @endphp
      
                                 {{$direccionPedido->nombre}} {{$direccionPedido->apellido}}<br>
                                 {{$direccionPedido->direccionExacta}}<br>
                                 {{$direccionPedido->puntoReferencia}}<br>
                                 {{$direccionPedido->primerTelefono}}<br>
                                 {{$direccionPedido->estado}}<br>
                                 {{$direccionPedido->municipio}}<br>
                                 {{$direccionPedido->parroquia}}<br>
                                 {{$direccionPedido->zona}}<br>
                                 
             
                             </div>
                         </div>
                     </div>
      
                      <div class=" col-sm-5">
                          <div class="panel panel-primary  mb-4" style="margin-left: 3%;" >
                              <div class="panel-body">
                                  <h6 class="card-title">Dirección de facturación</h6>
      
                                  @php
                                      $direccionFactura=DireccionFactura::where('id',$pedido->factura_id)->first();
                                  @endphp
      
                                  {{$direccionFactura->nombre}} {{$direccionFactura->apellido}}<br>
                                  {{$direccionFactura->direccionExacta}}<br>
                                  {{$direccionFactura->puntoReferencia}}<br>
                                  {{$direccionFactura->primerTelefono}}<br>
                                  {{$direccionFactura->estado}}<br>
                                  {{$direccionFactura->municipio}}<br>
                                  {{$direccionFactura->parroquia}}<br>
                                  {{$direccionFactura->zona}}<br>
      
                              </div>
                          </div>
                      </div>
                     </div>   



                    <div class="panel panel-primary mb-4 " >
                        <div class="panel-heading">
                            <h5 class="panel-title">Productos de pedido</h5> 
                            <div class="pull-right">

                            </div>
                        </div>
                        <div class="panel-body">
                            @if($pedido->status=='culminado' || $pedido->status=='enviadoComprador')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <button  type="button"  class="btn btn-info  " data-toggle="modal" data-target="#hola">Calificar</button>
                                    </div>
                                </div>

                            </div>
                         @endif 
                           <div class="row">
                               <div class="col-sm-12">

                                   <table id="example" class="table table-striped table-bordered" style="width:100%">
                                     <thead>
                                         <tr>
                                             <th>Sku</th>
                                             <th>Producto</th>
                                             <th>Cantidad</th>
                                             <th>Precio unitario</th>
                                             <th>Precio total</th>
                                         
                                         </tr>
                                     </thead>
                                     <tbody>
                                       @php
                                       $montoTotaal=0;
                                       @endphp
                                         @foreach ($pedido->producto as $item)
                                             
                                         @if($item->tipoCliente=='combinacion')
                                               
                                         <?php
       
                                           $combinacion=Combinacion::where('id',$item->pivot->combinacion_id)->first();
                                           ?>
                                       
                                         @endif
       
       
                                         <tr>
                                             <td>{{$item->sku}} <br>
                                             <td>{{$item->nombre}} <br>
                                                @if($item->tipoCliente=='combinacion')
                                               <span>
                                                   @foreach ($combinacion->atributo as $items)
                                                       
                                                   {{$items->grupoAtributo->nombre}}: {{$items->nombre}} |
                   
                                                   @endforeach
                                               </span>
                                               @endif
                                           </td>
                                           
                                           <td>
                                               {{$item->pivot->cantidadProducto}}
                                           </td>
                                           <td>
                                               Bs{{$item->pivot->precioProducto}}
                                           </td>
                                           <td>
                                               Bs{{$item->pivot->cantidadProducto*$item->pivot->precioProducto}}
                                           </td>
                                            
                                           <?php $montoTotaal=$montoTotaal+($item->pivot->cantidadProducto*$item->pivot->precioProducto);?>




                                       </tr>
                                       @endforeach
                                        
                                     </tbody>
                                  
                                   </table>

                                   <div id="hola" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                    
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                    <form action="{{url('/comprador/calificar')}}" method="POST">
                                        @csrf
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"></h4>
                                            </div>
                                            <div class="modal-body">
                                           
                                                


            
                                            <input type="hidden" name="pedido_id" value="{{$pedido->id}}">

                                            

                                                <p class="clasificacion">
                                                    <span>Nivel de calificacin<span>
                                                    <input id="radio1" type="radio" name="estrellas" value="5"><!--
                                                    --><label for="radio1"><i class="fa fa-star"></i></label><!--
                                                    --><input id="radio2" type="radio" name="estrellas" value="4"><!--
                                                    --><label for="radio2"><i class="fa fa-star"></i></label><!--
                                                    --><input id="radio3" type="radio" name="estrellas" value="3"><!--
                                                    --><label for="radio3"><i class="fa fa-star"></i></label><!--
                                                    --><input id="radio4" type="radio" name="estrellas" value="2"><!--
                                                    --><label for="radio4"><i class="fa fa-star"></i></label><!--
                                                    --><input id="radio5" type="radio" name="estrellas" value="1"><!--
                                                    --><label for="radio5"><i class="fa fa-star"></i></label>
                                                </p>
                                            
                                                <div class="form-group">
                                                    <span >Titulo</span>

                                                    <select name="producto_id" class="form-control">
                                                     @foreach ($pedido->producto as $item)
                                                    <option value="{{$item->id}}">{{$item->sku}}</option>
                                                     @endforeach
                                                    </select>
                                                </div>


                                                <div class="form-group ">
                                                    <span >Titulo</span>
                                                    <input type="text" name="titulo" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <span>Comentario</span>
                                                    <textarea name="comentario" class="form-control">
                                                    </textarea>
                                                </div>



                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-info">Calificar</button>
                                            </div>

                                    </form>
                                    </div>
                                
                                    </div>
                                    </div>


                               </div>
                               
                            </div> 

                            <div class="row">
                                <div class="col-sm-6 pull-right">
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                        <td colspan="2">
                                            <table class="table table-condensed total-result">
                                                <tr>
                                                    <td>Total del carrito</td>
                                                    <td>Bs{{$montoTotaal}}</</td>
                                                </tr>
                                                
                                                <tr class="shipping-cost">
                                                    <td>Costo de envío</td>
                                                    <td>
                                                        @if($pedido->precioEnvio!='0')
                                                        Bs{{$pedido->precioEnvio}}
                                                        @else
                                                        Envio gratis
                                                        @endif
                                                    </td>			
                                                </tr>
                                                
            
                                                <tr class="shipping-cost">
                                                @if(!empty($pedido->codigoCupon))
                                                <td>Cupón</td>
                                                <td>
                                                    Bs{{$pedido->cantidadCupon}}
                                                </td>	
                                                @endif	
                                                </tr>
                                                @if(!empty($pedido->descuentoAficional))	
                                                <tr class="shipping-cost">
                                                    <td>Descuento adicional</td>
                                                <td>
                                                    Bs {{$pedido->descuentoAficional}}
                                                </td>			
                                                </tr>
                                                @endif
                                                <tr>
                                                    <td>Monto Total</td>
                                                <td><span>Bs {{$pedido->montoTotal}}</span></td>
                                                </tr>
                                                <tr>
                                                    
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </div>
                            </div>
      
                        </div>
                      </div>

                      
                    

                      <div class="panel panel-primary mb-4  " >
                        <div class="panel-heading">
                            <span>

                                <h5 class="panel-title">Estado de envio</h5>
                            </span>
                            
                        </div>
                        <div class="panel-body">
                            
                            <div class="form-group">
                               <div class="row">
                                    
                                       
                                            <div class="col-sm-4">

                                                <dt class="">Fecha</dt>
                                                @if ($pedido->referenciaEnvio)
                                                {{$pedido->updated_at->format('d-m-Y')}}
                                                @else  
                                                <dd class="">En espera</dd>
                                                @endif
                                            </div>
                                            <div class="col-sm-4">

                                                <dt class="">Medio de envio</dt>
                                            <dd class="">{{$pedido->medioEnvio->nombre}}</dd>
                                            </div>
                                            <div class="col-sm-4">

                                                <dt class="">Referencia de envio</dt>
                                                @if ($pedido->referenciaEnvio)
                                                {{$pedido->referenciaEnvio}}
                                                @else   
                                                <dd class="">En espera</dd>
                                                @endif
                                                
                                            </div>
                                           

                               </div>

                            </div>
                        </div>
                    </div>

                

        </div>
    </div>
</section>

@endsection

