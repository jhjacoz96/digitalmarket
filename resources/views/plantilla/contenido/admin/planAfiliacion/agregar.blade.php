@extends('layouts.appAdmin')
@section('contenido')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Plan de afiliación</h1>
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
                <h3 class="card-title">Agregar plan de afiliación</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('Plan.store')}}" method="post" id="quickForm">
                @csrf
                <div class="card-body">

                  

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" required="true" name="nombre" class="form-control" id="nombre" placeholder="Premium">
                    {!!$errors->first('nombre','<small>:message</small><br>')!!}

                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1" >Exposición en el listado</label>
                    <select name="exposicion" class="form-control" id="">
                      <option value="">Seleccione un nivel</option>
                      <option value="Maxima">Maxima</option>
                      <option value="Alta">Alta</option>
                      <option value="Baja">Baja</option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="">stock maximo por producto</label>
                    <input  class="form-control" placeholder="60" name="tiempoPublicacion"  type="text">
                    <small>(Si deja este campo vacio, el stock será ilimitado)</small>
                  </div>
               
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Descripción</label>
                    
                    <textarea  name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Ingrese una descripcón corta"></textarea>
                    {!!$errors->first('descripcion','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Porcentaje de costo por venta (Porcentaje)</label>
                    <input type="text"  name="porcentaje" class="form-control" id="porcentaje"  placeholder="10">
                    {!!$errors->first('porcentaje','<small>:message</small><br>')!!}
                  </div>



                  <div class="form-group col-md-6">
                    <label for="">Cantidad de publicaciones activas</label>
                    <input  class="form-control" type="text" name="cantidadPublicacion" placeholder="2">
                    <small>(Si deja este campo vacio, la canidad será ilimitada)</small>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox"  class="custom-control-input" id="activo" name="activo">
                      <label class="custom-control-label" for="activo">Activo</label>
                    </div>
                  </div>

                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit"  class="btn btn-primary float-right">Agregar Plan de afiliación</button>
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
