@extends('layouts.appAdmin')
@section('contenido')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       
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
                <h3 class="card-title">Actualizar comprador</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('Comprador.update',$comprador)}}" method="post" id="quickForm">
                @method('PUT')
                @csrf
                
                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                <input type="text" required="true" name="nombre" value="{{$comprador->nombre}}" class="form-control" id="nombre" placeholder="Ingrese su nombre">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Apellido</label>
                    <input type="text" required="true" value="{{$comprador->apellido}}"
                    name="apellido" class="form-control" id="apellido" placeholder="Ingrese su apellido">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Correo electrónico</label>
                    <input type="text" required="true" name="correo" class="form-control" value="{{$comprador->correo}}"id="correo" placeholder="Ingrese un correo electrónico">
                  </div>

                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
               
                <a type="submit" href="{{route('Comprador.password',$comprador)}}" class="btn btn-secondary float-left">Actualizar contraseña</a>

                <button type="submit"  class="btn btn-primary float-right">Actualizar comprador</button>
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