@extends('layouts.appAdmin')
@section('contenido')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pedido</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="">Consultar</a></li>
            <li class="breadcrumb-item active">Detalle</li>
          </ol>

        </div>
      </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="p-2">
      @include('flash::message')
   </div>

    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->


          <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-calendar-alt"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Fecha</span>
                <span class="info-box-number">{{$pedido->created_at->format('d/m/Y')}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">  
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-money-bill-alt"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Monto total</span>
                  <span class="info-box-number">
                   
                   Bs {{$pedido->montoTotal}}
                    
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
           
          <!--  
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Uploads</span>
                  <span class="info-box-number">13,648</span>
                </div>
               
              </div>
              
            </div>
            
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Likes</span>
                  <span class="info-box-number">93,139</span>
                </div>
             
              </div>
              
            </div>
           
          -->
          </div>

          <div class="row">

            <div class="col-md-6">

              <div class="card card-secondary ">
                <div class="card-header">
                  <span class="fas fa-user float-left"></span>
                  <h3 class="card-title ml-1">Comprador {{$pedido->comprador->nombre}}
                    {{$pedido->comprador->apellido}}</h3>
                    <a  href="{{route('Comprador.show',$pedido->comprador->id)}}"><span class="fas fa-eye float-right"></span></a>

                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <div class="card-body">
                  <dl class="row">

                    <dt class="col-sm-4">Correo del comprador</dt>
                    <dd class="col-sm-8">{{$pedido->comprador->correo}}</dd>
                 
                  </dl>
                  <div class="col-md-6">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-md-6">

              <div class="card card-secondary ">
                <div class="card-header">
                  <span class="fas fa-box-open float-left"></span>
                  <h3 class="card-title ml-1"> Pedido {{$pedido->id}}</h3>

                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <div class="card-body">
                  @if($pedido->status!='esperaTransferencia')
                    <div class="row">
                      <div class="form-group">
                        <p> <a href="{{url('/pedido-factura/'.$pedido->id)}}" class="btn btn-info"><i class="fas fa-file-invoice"></i> Generar factura</a></p>
                      </div>
                    </div>
                  @endif
                  <div class="row">
                    <div class="form-group">

                      <span>
                        Estado del pedido
                      </span>
                    
                      @if($pedido->status=='esperaTransferencia')
                        <span class="badge badge-primary">Espera por transferencia</span>
                      @endif
                          
                      @if($pedido->status=='pagoAceptado')
                        <span class="badge badge-success">Pago aceptado</span>
                      @endif

                      @if($pedido->status=='cancelado')
                        <span class="badge badge-danger">Cancelado</span>
                      @endif
                      
                      @if($pedido->status=='preparandoPedido')
                        <span class="badge badge-warning">Preparando pedido para enviar</span>
                      @endif

                      @if($pedido->status=='enviadoComprador')
                        <span class="badge" style="background-color:deeppink; color: floralwhite;">Enviado al comprador</span>
                      @endif

                      @if($pedido->status=='culminado')
                        <span class="badge" style="background-color:darkorchid; color: floralwhite;">Culminado</span>
                      @endif

                    </div>
                  </div>

                <form action="{{url('/pedido/status/'.$pedido->id)}}" method="post">
                  @method('PUT')
                  @csrf
                  <div class="row">

                    <div class="col-md-6">
                      
                      <div class="form-group">
                        
                        <select class="form-control" name="estado" id="">

                          @if($pedido->status=='esperaTransferencia')
                          <option
                          @if($pedido->status=='esperaTransferencia')
                          selected
                          @endif
                          value="esperaTransferencia">Espera por transferencia</option>
                          <option
                          @if($pedido->status=='cancelado')
                          selected
                          @endif
                          value="cancelado">Cancelar pedido</option>
                          <option 
                          @if($pedido->status=='pagoAceptado')
                          selected
                          @endif
                          value="pagoAceptado">Pago aceptado</option>
                          @endif

                          @if($pedido->status=='cancelado')
                          <option
                          @if($pedido->status=='cancelado')
                          selected
                          @endif
                          value="cancelado">Cancelar pedido</option>
                          @endif
                        

                          @if($pedido->status=='pagoAceptado')

                            <option
                            @if($pedido->status=='preparandoPedido')
                            selected
                            @endif
                            value="preparandoPedido">Preparando pedido</option>
                          @endif
                            @if($pedido->status=='preparandoPedido')

                                <option
                                @if($pedido->status=='enviadoComprador')
                                selected
                                @endif
                                value="enviadoComprador">Enviado al comprador</option>
                          @endif
                                @if($pedido->status=='enviadoComprador')

                                  <option
                                  @if($pedido->status=='culminado')
                                  selected
                                  @endif
                                  value="culminado">Culminado</option>

                                @endif

                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <button onclick="return confirm('¿Esta seguro que desea modificar el estado de este pedido')" type="submit" class="btn btn-primary btn-sm">Modificar</button>
                    </div>
                  </div>
                  </form>

                </div>
              </div>

            </div>

          </div>


          <div class="card card-secondary ">
            <div class="card-header">
              <span class="fas fa-shipping-fast float-left"></span>
              <h3 class="card-title ml-1">Medio de pago</h3>

            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <div class="card-body">

              <div class="card-body table-responsive p-0">
                <table class="table table-striped">
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
                        
                    <tr>
                    <td class="mailbox-star">{{$item->nombre}}</td>
                      <td class="mailbox-star">{{$item->tipoPago}}</td>
                      <td class="mailbox-star">{{$item->moneda}}</td>
                      <td class="mailbox-star">
                        @if($item->pivot->referencia=='')
                          En espera
                        @else
                        {{$item->pivot->referencia}}
                        @endif
                      </td>
                    <td class="mailbox-star">{{$item->pivot->status}}</td>
                      <td class="mailbox-star">
                        @if($item->moneda=='Bolivares')
                        Bs {{$item->pivot->cantidad}}
                        @else
                        $ {{$item->pivot->cantidad}}
                        @endif
                      </td>
                      <td>
                        @if($item->pivot->status!='Aceptado' && $item->pivot->referencia!='')
                          <div class="btn-group">
                          <a href="{{url('/pedido/pago/'.$item->pivot->id.'/'.'aceptado')}}" onclick="return confirm('Antes de aceptar un pago debe verificar la referencia. ¿Esta seguro que desea aceptar este pago? ')" class="btn btn-default btn-sm">  <span class="fas fa-check" aria-hidden ="true" ></span></a>
                            <a href="{{url('/pedido/pago/'.$item->pivot->id.'/'.'denegado')}}" onclick="return confirm('Antes de denegar un pago debe verificar la referencia. ¿Esta seguro que desea denegar este pago? ')" class="btn btn-default btn-sm">  <span class="fas fa-ban" aria-hidden ="true" ></span></a>
                          </div>
                        @endif
                      </td>
                  
                    </tr>

                    @endforeach

                  </tbody>
                </table>
              </div>

            </div>


          </div>

          <div class="card card-secondary ">
            <div class="card-header">
              <span class="fas fa-shipping-fast float-left"></span>
              <h3 class="card-title ml-1">Medio de envio</h3>

            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <div class="card-body">

              <div class="card-body table-responsive p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Medio de envío</th>
                      <th>Fecha de envío</th>
                      <th>Referencia de envío</th>
                    </tr>
                  </thead>
                  <tbody>


                    <tr>
                      <td class="mailbox-star">{{$pedido->medioEnvio->nombre}}</td>
                      <td class="mailbox-star">
                        @if($pedido->status=='enviadoComprador')
                        {{$pedido->updated_at->format('d-m-Y')}}
                        @else
                        En espera
                        @endif
                      </td>
                      <td class="mailbox-star">
                        @if($pedido->status=='enviadoComprador')
                        {{$pedido->referenciaEnvio}}
                        @else
                        En espera
                        @endif
                      </td>
                      <th>

                      </th>
                      <th>
                        @if($pedido->status=='preparandoPedido')
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                          Actualizar
                        </button>
                        @endif
                      </th>

                    </tr>

                    <div class="modal fade" id="modal-default">
                    <form action="{{url('/pedido/status/'.$pedido->id)}}" method="post">
                      @csrf
                      @method('PUT')
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Actualizar envio</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="">Referencia de envio</label>
                              <input name="referencia" type="text"  class="form-control">
                              <input name="estado" type="hidden" value="enviadoComprador" class="form-control">

                            </div>
                            <div class="form-group">
                              <p>Esta acción cambiará el estado del pedido a <span class="badge" style="background-color:deeppink; color: floralwhite;">Enviado al comprador</span></p>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </form>
                    </div>


                  </tbody>
                </table>
              </div>

            </div>


          </div>


          <div class="card card-secondary">
            <div class="card-header">
              <span class="fas fa-box-open float-left"></span>

              <h3 class="card-title ml-1">Productos<span class="badge badge-info">{{count($pedido->producto)}}</span>
              </h3>
            </div>

            

              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Tienda</th>
                          <th>Producto</th>
                          <th>Cantidad</th>
                          <th>Precio</th>
                          <th>Total</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $montoTotaal=0;
                        @endphp
                        @foreach ($pedido->producto as $item)
    
                        <tr>
                          <td class="mailbox-star">{{$item->id}}</td>
                          <td class="mailbox-star">{{$item->tienda->nombreTienda}}</td>
                          <td class="mailbox-star">{{$item->nombre}}</td>
                          <td class="mailbox-star">
                            {{$item->pivot->cantidadProducto}}
                          </td>
                          <td class="mailbox-star">Bs {{$item->pivot->precioProducto}}</td>
                          <td class="mailbox-star">Bs {{$item->pivot->precioProducto*$item->pivot->cantidadProducto}}</td>
                          <td class="mailbox-star">
  
                            <?php $montoTotaal=$montoTotaal+($item->pivot->cantidadProducto*$item->pivot->precioProducto);?>
  
                            @if($item->pivot->status=='enviadoAlmacen')
                              <span class="">Enviado al almacen</span>
                            @endif
                            @if($item->pivot->status=='listoEnviar')
                              <span class="">Listo para enviar</span>
                            @endif
                         
                          </td>
    
                          @if($item->pivot->status=='pagoAceptado')
                          <td class="mailbox-star">
                          <a href="{{url('/estado-almacen/'.$item->pivot->id)}}" class="btn btn-default">Verificar</a>
                          </td>
                          @endif
    
                        </tr>
                        @endforeach
    
    
    
                      </tbody>
                    </table>
                  </div>
                </div>

              
                  <div class="row ">
                    <div class="col-md-6 float-right">
                      <div class="table-responsive">
                        <table class="table">
                          <tr>
                            
                            <th style="width:50%">Total del carrito:</th>
                            <td> 
                              Bs {{ $montoTotaal}}
                            </td>
                          </tr>
                          <tr>
                            <th>Costo de envio</th>
                            <td>
                              @if($pedido->precioEnvio!='0')
                                Bs{{$pedido->precioEnvio}}
                                @else
                                Envio gratis
                              @endif
                            </td>
                          </tr>
                          @if(!empty($pedido->codigoCupon))
                          <tr>
                            <th>Monto de cupón de descuento:</th>
                            <td> Bs {{$pedido->cantidadCupon}}</td>
                          </tr>
                          @endif
                          @if(!empty($pedido->descuentoAficional))
                          <tr>
                            <th>Descuento adicional:</th>
                            <td>Bs {{$pedido->descuentoAficional}}</td>
                          </tr>
                          @endif
                          <tr>
                            <th>Monto Total:</th>
                            <td><span>Bs {{$pedido->montoTotal}}</span></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
        
              </div>

         

          </div>



          <div class="card card-secondary ">
            <div class="card-header">
              <span class="fas fa-map-marked-alt float-left"></span>
              <h3 class="card-title ml-1">Dirección de envío</h3>

            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <div class="card-body">

              <div class="row">

                <div class="col-md-6">

                  <dl class="row">
                    <dt class="col-sm-8">Nombre</dt>
                    <dd class="col-sm-4">{{$pedido->direccionPedido->nombre}}</dd>
                    <dt class="col-sm-8">Apellido</dt>
                    <dd class="col-sm-4">{{$pedido->direccionPedido->apellido}}</dd>
                    <dt class="col-sm-8">Primer telefono</dt>
                    <dd class="col-sm-4">{{$pedido->direccionPedido->primerTelefono}}</dd>
                    <dt class="col-sm-8">Segundo telefono</dt>
                    <dd class="col-sm-4">{{$pedido->direccionPedido->segundoTelefono}}</dd>
                    <dt class="col-sm-8">Observación</dt>
                    <dd class="col-sm-4">{{$pedido->direccionPedido->observacion}}</dd>
                    <dt class="col-sm-8">Dirección exacta</dt>
                    <dd class="col-sm-4">{{$pedido->direccionPedido->direccionExacta}}</dd>

                  </dl>


                </div>

                <div class="col-md-6">
                  <dl class="row">

                    <dt class="col-sm-8">Estado</dt>
                    <dd class="col-sm-4">{{$pedido->direccionPedido->estado}}</dd>
                    <dt class="col-sm-8">Municipio</dt>
                    <dd class="col-sm-4">{{$pedido->direccionPedido->municipio}}</dd>
                    <dt class="col-sm-8">Parroquia</dt>
                    <dd class="col-sm-4">{{$pedido->direccionPedido->parroquia}}</dd>
                    <dt class="col-sm-8">Zona</dt>
                    <dd class="col-sm-4">{{$pedido->direccionPedido->zona}}</dd>
                    <dt class="col-sm-8">Punto de referencia</dt>
                    <dd class="col-sm-4">{{$pedido->direccionPedido->puntoReferencia }}</dd>
                  </dl>
                </div>

              </div>

            </div>
          </div>


          




          <!-- /.card -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection