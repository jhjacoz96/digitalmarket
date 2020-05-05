@extends('layouts.appAdmin')
@section('contenido')
<div id="metodoEnvio">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Metodo de pago</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('Plan.index')}}">Consultar</a></li>
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
                <h3 class="card-title">Agregar metodo de pago</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('metodoPago.store')}}" method="post" id="quickForm">
                @csrf
                <div class="card-body">

                  

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" required="true" name="nombre" class="form-control" id="nombre" placeholder="">
                    {!!$errors->first('nombre','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6">
                    <label for="">Descipción</label>
                    <input  class="form-control" placeholder="60" name="descripcion"  type="text">
                  </div>

                  


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit"  class="btn btn-primary float-right">Agregar metodo de pago</button>
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
</div>
@endsection
