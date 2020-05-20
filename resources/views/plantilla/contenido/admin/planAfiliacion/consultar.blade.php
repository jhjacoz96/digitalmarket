@extends('layouts.appAdmin')
@section('contenido')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Cantidad de planes:{{count($plan)}}</h1>
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
                  <h3 class="card-title">Consultar Plan de afiliación</h3>
  
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Exposición en los listados</th>
                        <th>Costo por venta</th>
                        <th>stock maximo por producto</th>
                        <th>Cantidad de publicaciones activas</th>
                        <th>Cantidad de tiendas afiliadas</th>
                        <th>Estado</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                       @foreach ($plan as $item)
                           
                       <tr>
                       <td class="mailbox-star">{{$item->id}}</td>
                           <td class="mailbox-star">{{$item->nombre}}</td>
                           <td class="mailbox-star">{{$item->descripcion}}</td>
                           <td class="mailbox-star">{{$item->exposicion}}</td>
                           <td class="mailbox-star">
                             @if($item->precio==0)
                             <span>Gratis</span>
                             @else
                             {{$item->precio}}% por venta
                             @endif
                            </td>
                           <td class="mailbox-star">
                             @if($item->tiempoPublicacion==null)
                             <span>Ilimitado</span>
                             @else
                             {{$item->tiempoPublicacion}} unidades
                             @endif
                            </td>
                           <td class="mailbox-star">
                             @if($item->cantidadPublicacion==null)
                              <span>Ilimitado</span>
                              @else
                             {{$item->cantidadPublicacion}} 
                             @endif
                            </td>
                           <td class="mailbox-star">0</td>
                           <td class="mailbox-star">
                             @if($item->estatus=='A')
                             <span class="badge badge-success">Activo</span>
                             @else
                             <span class="badge badge-danger">Inactivo</span>
                            @endif
                          </td>
                           
                           <td class="mailbox-star">
                               <div class="btn-group">
                               <a href="{{route('Plan.edit',$item)}}" class="btn btn-default btn-sm">  <span class="fas fa-edit" aria-hidden ="true" ></span></a>

                               @if($item->nombre!='gratuita'||$item->nombre!='Gratuita')
                               
                                   <form action="{{route('Plan.destroy',$item)}}" method="POST"  >
                                       @method('DELETE')
                                       @csrf
                                       <button class="btn btn-default btn-sm d-inline float-left" onclick="return confirm('¿Esta seguro que desea eliminar este comprador?')"><span class="fas fa-trash-alt" aria-hidden ="true" ></span></button>
                                     </form>
                                     
                                  @endif
                                   
                                 
                               </div>
                           </td>
                       </tr>
                       @endforeach
                            
                        
                    
                     
                    </tbody>
                  </table>
                  <div class="box-footer p-3 ">
                  <a href=" {{route('Plan.create')}} "  class="btn  btn-info float-right">Agregar Plan de afilización</a>
            
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