@extends('layouts.appAdmin')
@section('contenido')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h5>Cantidad de medios de envío:{{count($envio)}}</h5>
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
                  <h3 class="card-title">Consultar medios de envío</h3>
  
                  
                </div>
             
                
                <!-- /.card-header -->
                <div class="card-body ">
                  <div  class="table-responsive">
                  <table id="table_id" class="display">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tiempo de entrega</th>
                        <th>Rango</th>
                        <th>Envío gratis</th>
                        <th>Estado</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                       @foreach ($envio as $item)
                           
                       <tr>
                       <td class="mailbox-star">{{$item->id}}</td>
                           <td class="mailbox-star">{{$item->nombre}}</td>
                           <td class="mailbox-star">{{$item->tiempoEntrega}}</td>
                           <td class="mailbox-star">
                            @if($item->dentroIribarren=='no')
                              Nacional
                            @else
                              Solo Iribarren
                            @endif
                          </td>
                           <td class="mailbox-star">
                            @if ($item->envioGratis=='A')
                            Si
                            @else
                            No
                            @endif
                            
                            </td>
                           @if($item->status=='A')
                           <td class="mailbox-star">
                            <span class="badge badge-success">Activo</span>       
                            </td>
                           @else
                            <td class="mailbox-star">
                            <div class="badge badge-danger">Inactivo</div>       
                            </td>
                            @endif

                           <td class="mailbox-star">
                               <div class="btn-group">
                               

                               <a href="{{route('metodoEnvio.edit',$item)}}" class="btn btn-default btn-sm">  <span class="fas fa-edit" aria-hidden ="true" ></span></a>

                                   
                                   
                                   <form action="{{route('metodoEnvio.destroy',$item)}}" method="POST">
                                       @method('DELETE')
                                       @csrf
                                       <button class="btn btn-default btn-sm d-inline float-left" onclick="return confirm('¿Esta seguro que desea eliminar este medio de envio?')"><span class="fas fa-trash-alt" aria-hidden ="true" ></span></button>
                                     </form>
                                   
                                   
                                 
                               </div>
                           </td>
                       </tr>
                       @endforeach
                            
                        
                    
                     
                    </tbody>
                  </table>
                </div>

                  <div class="box-footer p-3 float-right">
                  <a href=" {{route('metodoEnvio.create')}} "  class="btn  btn-info ">Agregar medio de envío</a>
            
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