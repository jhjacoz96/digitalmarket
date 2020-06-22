@extends('layouts.appAdmin')
@section('contenido')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Pagos a tiendas</h1>
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
                  <h3 class="card-title">Consultar pagos a tiendas</h3>
  
                  
                </div>
                
                <!-- /.card-header -->
                <div class="card-body ">
                  <div class="table-responsive p-0">
                    <table id="table_id" class="display">
                      <thead>
                        <tr>
                          <th>ID</th>
                         
                          <th>Monto a pagar</th>
                          <th>Id pedido</th>
                          <th>Código tienda</th>
                          <th>Nombre tienda</th>
                          <th>Estado</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                         @foreach ($tiendaPago as $item)
                         <tr>
                         <td class="mailbox-star">{{$item->id}}</td>
                             <td class="mailbox-star">Bs {{$item->montoPagado}}</td>
                             <td class="mailbox-star"> 
                              {{$item->pedido->id}}
                             </td>
  
                             <td class="mailbox-star"> 
                              {{$item->tienda->codigo}}
                             </td>
  
                             <td class="mailbox-star"> 
                              {{$item->tienda->nombreTienda}}
                             </td>
                             <td class="mailbox-star"> 
                              @if($item->status=='espera')
                              En espera
                              @else
                              Pagado
                              @endif
  
                             </td>
  
                             <td class="mailbox-star">
                                 <div class="btn-group">
                                 
                                  @if($item->status!='pagado')
                                 <a href="{{url('/pago-tienda/'.$item->id)}}" class="btn btn-default btn-sm" >  <span class="far fa-money-bill-alt" aria-hidden ="true" ></span></a>
                                     @endif
                              
                                 </div>
                             </td>
                         </tr>
                         @endforeach
                              
                          
                      
                       
                      </tbody>
                    </table>
                  </div>
                  

                  <div class="box-footer p-3 float-right">
                  
                    
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