@extends('layouts.appAdmin')
@section('contenido')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
    <h1>Mi perfil</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('administrador.show',Auth::user()->id)}}">Perfil</a></li>
          <li class="breadcrumb-item active">Actualizar contraseña</li>
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

                <h3 class="card-title">Modificar contraseña</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('Empleado.updatePassword',$user)}}" method="post" id="quickForm">
              
                @csrf
              
                <div class="p-2">
                  @include('flash::message')
               </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputPassword1">Antigua contraseña</label>
                    <input type="password" name="vieja" class="form-control" id="exampleInputPassword1" placeholder="Ingrese la antigua contraseña">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Nueva contraseña</label>
                    <input type="password" name="password" class="form-control" required id="exampleInputPassword1" placeholder="Ingrese la nueva contraseña" autocomplete="new-password">
                    {!!$errors->first('password','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Confirme la contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" required id="exampleInputPassword1" placeholder="Confirme la nueva contraseña" autocomplete="new-password">
                    
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Actualizar contraseña</button>
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