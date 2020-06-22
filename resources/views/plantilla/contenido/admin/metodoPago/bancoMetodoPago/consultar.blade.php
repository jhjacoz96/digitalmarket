@extends('layouts.appAdmin')
@section('contenido')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Cantidad de bancos:{{count($banco)}}</h1>
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
                  <h3 class="card-title">Consultar bancos para metodos de envios</h3>
  
                  
                </div>
                
                <!-- /.card-header -->
                <div class="card-body ">
                  <div class="table-responsive p-0">
                    <table id="table_id" class="display">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nombre banco</th>
                          <th>Detalle de la cuenta</th>
                          <th>Titular</th>
                          <th>Documento de identidad</th>
                          <th>Tipo de cuenta</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                         @foreach ($banco as $item)
                             
                         <tr>
                         <td class="mailbox-star">{{$item->id}}</td>
                             <td class="mailbox-star">{{$item->nombreBanco}}</td>
                             <td class="mailbox-star">{{$item->detalleCuenta}}</td>
                             <td class="mailbox-star">
                              
                              @if($item->titular)
                                {{$item->titular}}
                              @else
                              <span>Sin registro</span>
                              @endif
  
                              </td>
                             <td class="mailbox-star">
  
                              
                               @if($item->tipoDocumento && $item->documentoIdentidad )
                               {{$item->tipoDocumento}}{{$item->documentoIdentidad}}
                             @else
                             <span>Sin registro</span>
                             @endif
  
                              </td>
                             <td class="mailbox-star">
                             
                              @if($item->tipoCuenta)
                                {{$item->tipoCuenta}}
                              @else
                                <span>Sin registro</span>
                              @endif
                              </td>
  
                             <td class="mailbox-star">
                                 <div class="btn-group">
                                 
  
                                 <a href="{{route('bancoMetodoPago.edit',$item)}}" class="btn btn-default btn-sm">  <span class="fas fa-edit" aria-hidden ="true" ></span></a>
  
                                     
                                     
                                     <form action="{{route('bancoMetodoPago.destroy',$item)}}" method="POST">
                                         @method('DELETE')
                                         @csrf
                                         <button class="btn btn-default btn-sm d-inline float-left" onclick="return confirm('¿Esta seguro que desea eliminar este banco?')"><span class="fas fa-trash-alt" aria-hidden ="true" ></span></button>
                                       </form>
                                     
                                     
                                   
                                 </div>
                             </td>
                         </tr>
                         @endforeach
                              
                          
                      
                       
                      </tbody>
                    </table>
                  </div>
                  
                  <div class="box-footer p-3 float-right">
                  <a href=" {{route('bancoMetodoPago.create')}} "  class="btn  btn-info ">Agregar banco</a>
            
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