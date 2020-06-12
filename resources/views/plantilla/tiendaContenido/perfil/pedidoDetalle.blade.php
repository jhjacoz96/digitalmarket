@extends('layouts.frondTienda.design')
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
                      <h5 class="card-title">Métodos de pago</h5>
                      </span>
                  </div>
                  <div class="panel-body">

                      <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Metodo de pago</th>
                                <th>Tipo de metodo de pago</th>
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
                                           
                                        <input class="form-control" value="{{$item->pivot->referencia}}" type="text" name="referencia">

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

                                            @if($item->pivot->status=='espera')
                                            <button type="submit" class="btn btn-default">Actualizar</button>
                                            @endif

                                            @if($item->pivot->status=='Denegado')
                                            <button type="submit" class="btn btn-default">Actualizar</button>
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
                                <dd class="col-sm-8"><p><a href="{{view('pdf.factura')}}" class="btn btn-info">Generar factura <i class="fas fa-file-invoice"></i></a></p></dd>
                                @endif

                            <dt class="col-sm-4">Fecha de creación</dt>
                            <dd class="col-sm-8">{{($pedido->created_at)->format('d-m-Y')}}</dd>
                           
                            <dt class="col-sm-4">Estado</dt>
                            <dd class="col-sm-8">
                                
                                @if($pedido->status=='esperaTransferencia')
                                <span class="label label-primary" >Espera por transferencia</span>
                                @endif

                                @if($pedido->status=='pagoAcepado')
                                <span class="label label-success">Pago aceptado</span>
                                @endif

                                @if($pedido->status=='cancelado')
                                <span class="label label-danger">Pedido cancelado</span>
                                @endif

                                @if($pedido->status=='enviado')
                                <span class="label label-danger">Pedido cancelado</span>
                                @endif

                                @if($pedido->status=='preparado')
                                <span class="label label-warning">Preparando pedido</span>
                                @endif
                                
                            </dd>
                                
                            </dl>
                        </div>
                    </div>
                </div>
                <div>
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
                        </div>
                        <div class="panel-body">
                           <div class="row">
                               <div class="col-sm-12">

                                   <table id="example" class="table table-striped table-bordered" style="width:100%">
                                     <thead>
                                         <tr>
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
                                             <td>{{$item->nombre}} <br>
                                               <span>
                                                   @foreach ($combinacion->atributo as $items)
                                                       
                                                   {{$items->grupoAtributo->nombre}}: {{$items->nombre}} |
                   
                                                   @endforeach
                                               </span>
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
                                                
                                                @if(\Auth::user()->comprador->tipoComprador->envioGratis===1)
                                                <tr class="shipping-cost">
                                                    <td>Costo de envío</td>
                                                    <td>Gratis</td>			
                                                </tr>
                                                @else
                                                <tr class="shipping-cost">
                                                    <td>Costo de envío</td>
                                                    <td>
                                                        @if(\Auth::user()->comprador->tipoComprador->envioGratis==0)
                                                        Bs{{$pedido->medioEnvio->precioEnvio}}
                                                        @else
                                                        Envio gratis
                                                        @endif
                                                    </td>			
                                                </tr>
                                                @endif
            
                                                <tr class="shipping-cost">
                                                    <td>Cupón</td>
                                                <td>
                                                    @if(!empty($pedido->codigoCupon))
                                                        Bs{{$pedido->cantidadCupon}}
                                                    @else
                                                        Bs0
                                                    @endif
                                                </td>			
                                                <tr class="shipping-cost">
                                                    <td>Descuento adicional</td>
                                                <td>
                                                   
                                                </td>			
                                                </tr>
                                                <tr>
                                                    <td>Monto Total</td>
                                                <td><span>Bs {{$pedido->montoTotal}}</span></td>
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
                                                <dd class="">En espera  </dd>
                                            </div>
                                            <div class="col-sm-4">

                                                <dt class="">Medio de envio</dt>
                                            <dd class="">{{$pedido->medioEnvio->nombre}}</dd>
                                            </div>
                                            <div class="col-sm-4">

                                                <dt class="">Número de seguimiento</dt>
                                                <dd class="">En espera</dd>
                                            </div>
                                           

                               </div>

                            </div>
                        </div>
                    </div>

                

        </div>
    </div>
</section>

@endsection

