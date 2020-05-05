@extends('layouts.appAdmin')
@section('contenido')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Comprador</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('Comprador.index')}}">Consultar</a></li>
            <li class="breadcrumb-item active">Agregar</li>
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


            <div class="card card-secondary">
              <div class="card-header">
                <span class="fas fa-user float-left"></span>
                <h3 class="card-title ml-1">Informaciòn sobre el comprador {{$comprador->nombre}} {{$comprador->apellido}}</h3>
              <a href="{{route('Comprador.edit',$comprador)}}">
                    <span class="fas fa-edit float-right" aria-hidden ="true" ></span>
                </a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Fecha de registro</dt>
                    <dd class="col-sm-8">{{$comprador->created_at}}</dd>
                        <dt class="col-sm-4">Correo electrónico</dt>
                        <dd class="col-sm-8">{{$comprador->correo}}</dd>
                        
                        <dt class="col-sm-4">Tipo de comprador</dt>
                    <dd class="col-sm-8">{{$comprador->tipoComprador->nombre}}</dd>
                        <dt class="col-sm-4">Estado</dt>
                        <dd class="col-sm-8">@if ($comprador->estatus=='A')
                            <span class="badge badge-success">Activo</span> 
                            @endif
                            @if ($comprador->estatus=='I')
                            <span class="badge badge-danger">Inactivo</span> 
                            @endif
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
            <div class="card card-secondary">
              <div class="card-header">
                  <span class="fas fa-shopping-bag float-left
                  "></span>
                <h3 class="card-title ml-1">Pedidos <span class="badge badge-info">0</span></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            
                <div class="card-body text-center">

                <span >{{$comprador->nombre}} {{$comprador->apellido}} todavía no ha realizado nungún pedido. </span>

                      
                  
                </div>
            </div>   
            <div class="card card-secondary">
              <div class="card-header">
                  <span class="fas fa-map-marker-alt float-left"></span>
                
                <h3 class="card-title ml-1">Direcciones <span class="badge badge-info">0</span></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            
              @if(count($comprador->direccion)==0)
               <div class="card-body text-center">
                <span >{{$comprador->nombre}} {{$comprador->apellido}} no posee direcciones disponibles. </span>
                </div>
              @endif
              @if(count($comprador->direccion)!=0)
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>direccion de envio</th>
                      <th>Código postal</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach ($comprador->direccion as $item)
                         
                     <tr>
                          <td class="mailbox-star">{{$item->id}}</td>
                         <td class="mailbox-star">{{$item->nombre}}</td>
                         <td class="mailbox-star">{{$item->apellido}}</td>
                         <td class="mailbox-star">{{$item->zona->parroquia->municipio->estado->nombre}}-{{$item->zona->parroquia->municipio->nombre}}-{{$item->zona->parroquia->nombre}}-{{$item->zona->nombre}}</td>
                         <td class="mailbox-star">{{$item->zona->codigoPostal}}</td>
                         
                         
                         <td class="mailbox-star">
                             <div class="btn-group">
                             

                             <a href="{{route('direccion.edit',$item->id)}}" class="btn btn-default btn-sm">  <span class="fas fa-edit" aria-hidden ="true" ></span></a>

                                 
                                 
                                 <form action="{{route('direccion.destroy',$item)}}" method="POST">
                                     @method('DELETE')
                                     @csrf
                                     <button class="btn btn-default btn-sm d-inline float-left" onclick="return confirm('¿Esta seguro que desea eliminar esta dircción?')"><span class="fas fa-trash-alt" aria-hidden ="true" ></span></button>
                                   </form>
                                 
                                 
                               
                             </div>
                         </td>
                     </tr>
                     @endforeach
                          
                      
                  
                   
                  </tbody>
                </table>
                </div> 

                @endif
               
               
               

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