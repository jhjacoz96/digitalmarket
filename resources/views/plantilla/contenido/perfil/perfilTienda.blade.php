@extends('layouts.appAdmin')

@section('contenido')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Perfil</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          
          <li class="breadcrumb-item active">Perfil</li>
          </ol>

      </div>

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
                <h3 class="card-title">Mi perfil</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="" method="post" id="quickForm">
                
                @csrf
                
                <div class="p-2">
                  @include('flash::message')
               </div>

                <div class="card-body box-profile">
              
                    <div class="text-center">
                        <img style="border-radius: 50%;" class="profile-user-img img-fluid img-circle"
                              @if(!empty($tienda->imagen->url))
                              src="{{$tienda->imagen->url}}"
                              @else
                              src="{{asset('/imagenes/tienda/tienda.png')}}"
                              @endif

                             alt="User profile picture">
                      </div>
      
                    <h3 class="profile-username text-center">{{$tienda->nombreTienda}}</h3>
                      
                    <p class="text-muted text-center">Plan de afiliacion {{$tienda->planAfiliacion->nombre}}</p>
                    
                    <p class="lead">Información de la tienda</p>
                      <hr>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre del encargado</label>
                        <input type="text" required="true" name="nombre" value="{{$tienda->nombre}}" class="form-control" id="nombre" placeholder="Ingrese su nombre" disabled>
                      </div>
                   
                      <div class="form-group">
                        <label for="exampleInputEmail1">Apellido del encargado</label>
                        <input type="text" required="true" value="{{$tienda->apellido}}"
                        name="apellido" class="form-control" id="apellido" placeholder="Ingrese su apellido" disabled>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Telefono</label>
                        <input type="text" required="true" value="{{$tienda->telefono}}"
                        name="apellido" class="form-control" id="apellido" placeholder="Ingrese su apellido" disabled>
                      </div>
                    
                      
                      <p class="lead">Información para la sesión</p>
                      <hr>
                        
                      <div class="form-group">
                        <label for="exampleInputEmail1">Correo electrónico</label>
                        <input type="text" required="true" name="correo" class="form-control" value="{{$tienda->correo}}"id="correo" placeholder="Ingrese un correo electrónico" disabled>
                      </div>
   
                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
               
                    <a type="submit" href="{{route('Empleado.password',$user->id)}}" class="btn btn-secondary float-left">Actualizar contraseña</a>

                    <a type="submit" href="{{route('administrador.edit',$user->id)}}"  class="btn btn-primary float-right">Actualizar perfil</a>
                    </div>
    

              </form>
              
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