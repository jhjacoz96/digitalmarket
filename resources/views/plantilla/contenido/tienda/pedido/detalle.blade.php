@extends('layouts.appAdmin')
@section('contenido')

@php
    use App\Combinacion;
    use App\Atributo;
    use App\GrupoAtributo;
@endphp

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
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->

        <div class="row">
            
            <div class="col-md-6">
    
                <div class="card card-secondary ">
                    <div class="card-header">
                      <span class="fas fa-user float-left"></span>
                      <h3 class="card-title ml-1">Pedido {{$pedido->id}} por {{$pedido->comprador->nombre}} {{$pedido->comprador->apellido}}</h3>
                    
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                  
                      <div class="card-body">
                          <dl class="row">
                              <dt class="col-sm-4">Fecha del pedido</dt>
                              <dd class="col-sm-8">{{$pedido->created_at}}</dd>
                              <dt class="col-sm-4">Correo del comprador</dt>
                              <dd class="col-sm-8">{{$pedido->comprador->correo}}</dd>
                              <dt class="col-sm-4">Total</dt>
                              <dd class="col-sm-8">
                                  <?php
                                  $total=0
                                  ?>
                                  @foreach ($pedido->producto as $item)
                                      @php
                                          $total=$total+($item->pivot->cantidadProducto*$item->pivot->precioProducto)
                                      @endphp
                                      Bs {{$total}}
                                  @endforeach
                              </dd>
      
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
                      <span class="far fa-money-bill-alt float-left"></span>
                      <h3 class="card-title ml-1">Pago por venta</h3>
                      
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                  
                      <div class="card-body">
                          <dl class="row">
                              <dt class="col-sm-8">Porcentaje por plan de afiliación</dt>
                              <dd class="col-sm-4">{{\Auth::user()->tienda->planAfiliacion->precio}}%</dd>
                              <dt class="col-sm-8">Monto por plan de afiliación</dt>
                              <dd class="col-sm-4">
                                  <?php
                                  $total=0;
                                  ?>
                                @foreach ($pedido->producto as $item)
                                <?php
                                    $total=$total+($item->pivot->cantidadProducto*$item->pivot->precioProducto);
                                ?>
                                @endforeach
                              Bs {{$total}}
                            </dd>
                              <dt class="col-sm-8">Total</dt>
                              <dd class="col-sm-4">
                               Bs {{$total-((\Auth::user()->tienda->planAfiliacion->precio/100)*$total)}}
                              </dd>
      
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

        </div>

    
                <div class="card card-secondary ">
                    <div class="card-header">
                      <span class="fas fa-shipping-fast float-left"></span>
                      <h3 class="card-title ml-1">Envio de pedido</h3>
                      
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                  
                      <div class="card-body">
                        <div class="row">
                        <a href="" data-toggle="modal" data-target="#modal-default">Ver reglas de envio</a>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                    <th>Medio de envío</th>
                                    <th>Fecha de envío</th> 
                                  <th>Número de guía</th>
                                </tr>
                              </thead>
                              <tbody>
                                 
                                     
                                 <tr>
                                     <td class="mailbox-star">{{$pedido->medioEnvio->nombre}}</td>
                                      <td class="mailbox-star">

                                      </td>
                                      <th>

                                      </th>
                                     <th>
                                     <form action="{{url('/pedido/status/'.$pedido->id)}}" method="post">
                                      @method('PUT')
                                      @csrf
                                     <input value="{{$pedido->medioEnvio->id}}" type="hidden" name="envio">
                                     <input value="tiendaPedido" type="hidden" name="ruta">
                                         <button type="submit" class="btn btn-info btn-sm" >
                                             Confirmar envio de pedido
                                         </button>
                                       </form>
                                     </th>
                                     
                                 </tr>
                                 
                                 <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Actualizar envio</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="callout callout-info">
                                            <h5>Reglas de envio</h5>
                                            <p>Este pedido Debe ser enviado a la bodega de DigitalMarket localizada en av. las industrias. Los productos debe estar embalados he identificados. Si el pedido no es entregado a tiempo su cuenta sera sancionada. Gracias por preferirnos como su medio de venta online.</p>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                                  
                               
                              </tbody>
                            </table>
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
                                    <dt class="col-sm-8">Parroquia</dt    >
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

       
            <div class="card card-secondary">
              <div class="card-header">
                  <span class="fas fa-box-open float-left"></span>
             
              <h3 class="card-title ml-1">Productos <span class="badge badge-info">{{count($pedido->producto)}}</span></h3>
              </div>

            
            <div class="row">

                <div class="card-body table-responsive p-0">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Producto</th>
                          <th>Tipo de producto</th>
                          <th>Cantidad</th>
                          <th>Precio</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                         @foreach ($pedido->producto as $item)
                             
                         <tr>
                              <td class="mailbox-star">{{$item->id}}</td>
                             <td class="mailbox-star">
                               {{$item->nombre}}<br>
                              @if($item->tipoCliente=='combinacion')
                                <?php
                                  $combinacion=Combinacion::find($item->pivot->combinacion_id);
                                ?>
                                @foreach ($combinacion->atributo as $com)
                                <p class="text-info">{{$com->grupoAtributo->nombre}} : {{$com->nombre}}</p> <br>
                                @endforeach
                              @endif
                              </td>
                             <td class="mailbox-star">{{$item->tipoCliente}}</td>
                             <td class="mailbox-star">
                                 {{$item->pivot->cantidadProducto}}
                             </td>
                            <td class="mailbox-star">Bs {{$item->pivot->precioProducto}}</td>
                            <td class="mailbox-star">Bs {{$item->pivot->precioProducto*$item->pivot->cantidadProducto}}</td>
                             
                         </tr>
                         @endforeach
                              
                          
                       
                      </tbody>
                    </table>
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