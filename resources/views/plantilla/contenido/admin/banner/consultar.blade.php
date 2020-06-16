@extends('layouts.appAdmin')
@section('contenido')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Cantidad de banner:{{count($banner)}}</h1>
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
                  <h3 class="card-title">Consultar banner</h3>
  
                  <div class="card-tools">

                    <form >
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="nombre" class="form-control float-right" placeholder="Buscar"
                      value="{{request()->get('nombre')}}"
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
                        <th>Titulo</th>
                        <th>Link</th>
                        <th>Banner</th>
                        <th>Estado</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                       @foreach ($banner as $item)
                           
                       <tr>
                       <td class="mailbox-star">{{$item->id}}</td>
                           <td class="mailbox-star">{{$item->titulo}}</td>
                           <td class="mailbox-star">{{$item->link}}</td>
                           <td class="mailbox-star"> <img style="width:200px;  border-radius:10px;" src="{{$item->imagen->url}}" ></td>
                           <td class="mailbox-star">
                               @if($item->estatus=='si')
                               <span class="badge badge-success">Activo</span>
                               @else
                               <span class="badge badge-success">Inactivo</span>
                               @endif
                            </td>
                         

                           <td class="mailbox-star">
                               <div class="btn-group">
                               

                               <a href="{{route('banner.edit',$item)}}" class="btn btn-default btn-sm">  <span class="fas fa-edit" aria-hidden ="true" ></span></a>

                                   
                                   
                                   <form action="{{route('banner.destroy',$item)}}" method="POST">
                                       @method('DELETE')
                                       @csrf
                                       <button class="btn btn-default btn-sm d-inline float-left" onclick="return confirm('¿Esta seguro que desea eliminar este banner?')"><span class="fas fa-trash-alt" aria-hidden ="true" ></span></button>
                                     </form>
                                   
                                   
                                 
                               </div>
                           </td>
                       </tr>
                       @endforeach
                            
                        
                    
                     
                    </tbody>
                  </table>
                  {{$banner->appends($_GET)->links()}}

                  <div class="box-footer p-3 float-right">
                  <a href=" {{route('banner.create')}} "  class="btn  btn-info ">Agregar banner</a>
            
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