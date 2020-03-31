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

                <div class="card-body">
                  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" required="true" name="nombre" value="{{$user->nombre}}" class="form-control" id="nombre" placeholder="Ingrese su nombre" disabled>
                    </div>
                 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Apellido</label>
                      <input type="text" required="true" value="{{$user->apellido}}"
                      name="apellido" class="form-control" id="apellido" placeholder="Ingrese su apellido" disabled>
                    </div>
                  
                      
                    <div class="form-group">
                      <label for="exampleInputEmail1">Correo electrónico</label>
                      <input type="text" required="true" name="correo" class="form-control" value="{{$user->email}}"id="correo" placeholder="Ingrese un correo electrónico" disabled>
                    </div>
                  

                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
               
                <a type="submit" href="{{route('Empleado.password',$user)}}" class="btn btn-secondary float-left">Actualizar contraseña</a>

                <a type="submit" href="{{route('administrador.edit',$user)}}"  class="btn btn-primary float-right">Actualizar perfil</a>
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