@extends('layouts.appAdmin')
@section('scripts')
    <script>
      window.data={
        editar:'no'
      }
    </script>
@endsection
@section('contenido')
<div id="metodoEnvio">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Medio de envío</h1>
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
                <h3 class="card-title">Agregar medio de envío</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('metodoEnvio.store')}}" method="post" id="quickForm">
                @csrf
                <div class="card-body">

                  

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" required="true" name="nombre" class="form-control" id="nombre" placeholder="Mrw">
                    {!!$errors->first('nombre','<small>:message</small><br>')!!}

                  </div>


                  <div class="form-group col-md-6">
                    <label for="">Tiempo de entrega</label>
                    <input  class="form-control" placeholder="24-48 horas" name="tiempoEntrega"  type="text">
                    {!!$errors->first('tiempoEntrega','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox"  
                      
                      class="custom-control-input" id="envioGratis"   v-model="envioGratis"
                       name="envioGratis">
                      <label class="custom-control-label" for="envioGratis">Envio gratis</label>
                    </div>
                  </div>


                  

                  <div class="form-group col-md-6" v-if="envioGratis==false">
                    <label for="">Precio de envio</label>
                    <input  class="form-control"  v-model="precioEnvio" placeholder="" name="precioEnvio"  type="text">
                    {!!$errors->first('precioEnvio','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox"
                      
                      class="custom-control-input" id="activo" name="activo">
                      <label class="custom-control-label" for="activo">Activo</label>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit"  class="btn btn-primary float-right">Agregar medio de envío</button>
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
