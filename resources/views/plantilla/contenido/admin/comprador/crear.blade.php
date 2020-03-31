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
                <h3 class="card-title">Agregar comprador</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('Comprador.store')}}" method="post" id="quickForm">
                @csrf
                <div class="card-body">

                  

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" required="true" name="nombre" class="form-control" id="nombre" placeholder="Ingrese su nombre">
                    {!!$errors->first('nombre','<small>:message</small><br>')!!}

                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Apellido</label>
                    <input type="text" required="true" name="apellido" class="form-control" id="apellido" placeholder="Ingrese su apellido">
                    {!!$errors->first('apellido','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Correo electrónico</label>
                    <input type="email" required="true" name="correo" class="form-control" id="correo" placeholder="Ingrese un correo electrónico">
                    {!!$errors->first('correo','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Ingrese su contraseña">
                    {!!$errors->first('password','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Confirme su contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" required id="exampleInputPassword1" placeholder="Ingrese de nuevo su contraseña" autocomplete="new-password">
                    {!!$errors->first('password_confirmation','<small>:message</small><br>')!!}
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Agregar comprador</button>
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
