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
                  <h3 class="card-title">Consultar pedidos</h3>
  
                  <div class="card-tools">

                    <form >
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="codigo" class="form-control float-right" placeholder="Código"
                      value="{{request()->get('codigo')}}"
                        >
    
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </form>

                    </div>
                  </div>
                </div>
                
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
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
                        {{$total}}
                      </td>

                      <td class="mailbox-star">
                        @if($item->status=='esperaTransferencia')
                          <span class="badge badge-primary">Espera por transferencia</span>
                        @endif
                        
                        @if($item->status=='pagoAceptado')
                          <span class="badge badge-success">Pago aceptado</span>
                        @endif
                        
                        @if($item->status=='enviadoComprador')
                          <span class="badge badge-info">enviado al comprador</span>
                        @endif

                        @if($item->status=='cancelado')
                          <span class="badge badge-danger">Cancelado</span>
                        @endif

                           </td>
                         
                           
                           <td class="mailbox-star">
                               <div class="btn-group">
                               

                               <a href="{{route('pedido.detalle',$item->id)}}" class="btn btn-default btn-sm">  <span class="fas fa-eye" aria-hidden ="true" ></span></a>
                               
                               </div>
                           </td>
                       </tr>
                       @endforeach
                            
                        
                    
                     
                    </tbody>
                  </table>
            

      
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