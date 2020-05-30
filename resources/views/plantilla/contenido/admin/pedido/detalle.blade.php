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
                  <span class="info-box-text">Total</span>
                  <span class="info-box-number">
                    <?php
                      $total=0
                    ?>
                    @foreach ($pedido->producto as $item)
                      @php
                        $total=$total+($item->pivot->cantidadProducto*$item->pivot->precioProducto)
                      @endphp
                    @endforeach

                    Bs {{$total}}
                    
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
                      
                      @if($pedido->status=='enviadoComprador')
                        <span class="badge badge-info ">enviado al comprador</span>
                      @endif

                      @if($pedido->status=='cancelado')
                        <span class="badge badge-danger">Cancelado</span>
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
                          <option
                          @if($pedido->status=='esperaTransferencia')
                          selected
                          @endif
                          value="esperaTransferencia">Espera por transferencia</option>
                          <option 
                          @if($pedido->status=='pagoAceptado')
                          selected
                          @endif
                          value="pagoAceptado">Pago aceptado</option>
                          <option
                          @if($pedido->status=='esperaComprador')
                          selected
                          @endif
                          value="enviadoComprador">Pedido envio</option>
                          <option
                          @if($pedido->status=='cancelado')
                          selected
                          @endif
                          value="cancelado">Pedido cancelado</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-primary btn-sm">Modificar</button>
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
              <h3 class="card-title ml-1">Metodo de pago</h3>

            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <div class="card-body">

              <div class="card-body table-responsive p-0">
                <table class="table table-striped">
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
                        
                    <tr>
                    <td class="mailbox-star">{{$item->nombre}}</td>
                      <td class="mailbox-star">{{$item->tipoPago}}</td>
                      <td class="mailbox-star">{{$item->moneda}}</td>
                      <td class="mailbox-star">{{$item->pivot->referencia}}</td>
                    <td class="mailbox-star">{{$item->pivot->status}}</td>
                      <td class="mailbox-star">
                        @if($item->moneda=='Bolivares')
                        Bs {{$item->pivot->cantidad}}
                        @else
                        $ {{$item->pivot->cantidad}}
                        @endif
                      </td>
                      <td>
                        <div class="btn-group">
                        <a href="{{url('/pedido/pago/'.$item->pivot->id.'/'.'aceptado')}}" class="btn btn-default btn-sm">  <span class="fas fa-check" aria-hidden ="true" ></span></a>
                          <a href="{{url('/pedido/pago/'.$item->pivot->id.'/'.'denegado')}}" class="btn btn-default btn-sm">  <span class="fas fa-ban" aria-hidden ="true" ></span></a>
                        </div>
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
              <h3 class="card-title ml-1">Metedo de envio</h3>

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
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                          Actualizar
                        </button>
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
                            <div class="form-group">
                              <label for="">Referencia</label>
                              <input name="referencia" type="text" class="form-control">

                            </div>
                            <div class="form-group">
                              <p>Al actualizar el pedido, los productos de su tienda pertenecientes a este pedido se
                                actualizaran como enviado al cliente</p>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary">Actualizar</button>
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


          <div class="card card-secondary">
            <div class="card-header">
              <span class="fas fa-box-open float-left"></span>

              <h3 class="card-title ml-1">Productos <span class="badge badge-info">{{count($pedido->producto)}}</span>
              </h3>
            </div>


            <div class="row">

              <div class="card-body table-responsive p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pedido->producto as $item)

                    <tr>
                      <td class="mailbox-star">{{$item->id}}</td>
                      <td class="mailbox-star">{{$item->nombre}}</td>
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