@extends('layouts.appAdmin')
@section('contenido')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Cantidad de pedidos:{{count($pedido)}}</h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Consultar</li>
            </ol>
        </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
      <!-- Main content -->
      <section class="content">


        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="p-2">
                  @include('flash::message')
               </div>

                <div class="card-header">
                  <h3 class="card-title">Consultar grupo de atributos</h3>
  
                </div>
                
                <!-- /.card-header -->
                <div class="card-body">
                  <div class=" table-responsive p-0">

                    <table id="table_id" class="display">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Fecha de pedido</th>
                          <th>Correo del comprador</th>
                          <th>Monto Total</th>
                          <th>estado</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                           $total=0;
                           ?>
                         @foreach ($pedido as $item)
                             
                         <tr>
                         <td class="mailbox-star">{{$item->id}}</td>
                         <td class="mailbox-star">{{$item->created_at}}</td>
                         <td class="mailbox-star">
                          {{$item->comprador->correo}}
                        </td>
                         <td class="mailbox-star">
                           
                          @foreach ($item->producto as $items)
                              <?php
                                $total=$total+($items->pivot->cantidadProducto*$items->pivot->precioProducto);
                              ?>
                          @endforeach
                          Bs {{$total}}
                        </td>
  
                             <td class="mailbox-star">
                              @if($item->status=='pagoAceptado')
                                <span class="badge badge-success">Pago aceptado</span>
                              @endif
                              @if($item->status=='preparandoPedido')
                                <span class="badge badge-warning">Preparando pedido</span>
                              @endif
                              @if($item->status=='cancelado')
                                <span class="badge badge-danger">Pedido cancelado</span>
                              @endif
                              @if($item->status=='enviadoComprador')
                                <span class="badge" style="background-color:deeppink; color: floralwhite;">Enviado al comprador</span>
                              @endif
                              @if($item->status=='recibido')
                                <span class="badge" style="background-color:darkorchid; color: floralwhite;">Recibido</span>
                              @endif
                             </td>
  
  
                             <td class="mailbox-star">
                                 <div class="btn-group">
                                 
  
                                 <a href="{{route('tiendas.pedido.detalle',$item->id)}}" class="btn btn-default btn-sm">  <span class="fas fa-eye" aria-hidden ="true" ></span></a>
                                 
                                 </div>
                             </td>
                         </tr>
                         @endforeach
                              
                          
                      
                       
                      </tbody>
                    </table>
                  </div>
           
                </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->


      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection