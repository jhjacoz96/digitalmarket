@extends('layouts.appAdmin')
@section('contenido')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Cantidad de compradores: {{count($comprador)}}</h1>
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
                  <h3 class="card-title">Consultar Comprador</h3>
  
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar comprador">
  
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
                        <th>Apellido</th>
                        <th>Correo electrónico</th>
                        <th>Fecha de registro</th>
                        <th>Estado</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($comprador as $item)
                    <tr >
                            <td class="mailbox-star">{{$item->id}}</td>
                            <td class="mailbox-star">{{$item->nombre}}</td>
                            <td class="mailbox-star">{{$item->apellido}}</td>
                            <td class="mailbox-star">{{$item->correo}}</td> 
                        <td class="mailbox-star">{{$item->created_at}}</td>
                    <td class="mailbox-star">
                      @if($item->estatus=='A')
                      <span>Si</span>
                      @else
                      <span>No</span>
                      @endif  
                    </td>
                            <td class="mailbox-star">
                                <div class="btn-group">
                                 <a class="btn btn-default btn-sm" href="{{route('Comprador.show',$item)}}"><span class="fas fa-eye"></span></a>
                                <a href="{{route('Comprador.edit',$item)}}" class="btn btn-default btn-sm mx-1">  <span class="fas fa-edit" aria-hidden ="true" ></span></a>

                                    
                                    
                                    <form action="{{route('Comprador.destroy',$item)}}" method="POST"  >
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-default btn-sm d-inline float-left" onclick="return confirm('¿Esta seguro que desea eliminar este comprador?')"><span class="fas fa-trash-alt" aria-hidden ="true" ></span></button>
                                      </form>
                                    
                                    
                                  
                                </div>
                            </td>
                        </tr>
                            
                        @endforeach
                    
                     
                    </tbody>
                  </table>
                  <div class="box-footer p-3 float-right">
                  <a href="{{route('Comprador.create')}}"  class="btn  btn-info ">Registrar Comprador</a>
            
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