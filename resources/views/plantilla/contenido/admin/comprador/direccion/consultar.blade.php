@extends('layouts.appAdmin')
@section('contenido')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Cantidad de direcciones:{{count($direccion)}}</h1>
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
                  <h3 class="card-title">Consultar direcciones</h3>
  
                  <div class="card-tools">

                    <form >
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="correo" class="form-control float-right" placeholder="Correo del comprador"
                      value="{{request()->get('correo')}}"
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
                        <th>correo del comprador</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>direccion de envio</th>
                        <th>Código postal</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                       @foreach ($direccion as $item)
                           
                       <tr>
                            <td class="mailbox-star">{{$item->id}}</td>
                           <td class="mailbox-star">{{$item->comprador->correo}}</td>
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
                  
                  <div class="box-footer p-3 float-right">
                  <a href=" {{route('direccion.create')}} "  class="btn  btn-info float-right">Agregar dirección</a>
            
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