@extends('layouts.appAdmin')
@section('contenido')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Direcciones de compradores</h1>
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
                <h3 class="card-title">Agregar dirección</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('direccion.store')}}" method="post" id="quickForm">
                @csrf
                <div class="card-body">

                  

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Correo de comprador</label>
                    <input type="email" required="true" name="correo" class="form-control" id="correo" placeholder="Ingrese un correo válido">
                    {!!$errors->first('correo','<small>:message</small><br>')!!}
                  </div>
                  <br>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" required="true" name="nombre" class="form-control" id="nombre" placeholder="Jhon">
                    {!!$errors->first('nombre','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Apellido</label>
                    <input type="text" required="true" name="Apellido" class="form-control" id="apellido" placeholder="Contreras">
                    {!!$errors->first('apellido','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6">
                    <label for="">Seleccione un estado</label>
                    <select class="form-control" name="estado" id="estado">
                      <option value="" selected>Seleccione un estado</option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="">Seleccione un municipio</label>
                    <select class="form-control" name="municipio" id="municipio">
                      <option value="" selected>Seleccione un municipio</option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="">Seleccione una parroquia</label>
                    <select class="form-control" name="parroquia" id="parroquia">
                      <option value="" selected>Seleccione una parroquia</option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Sector</label>
                    <input type="text" required="true" name="sector" class="form-control" id="sector" placeholder="Brisas del Obelisco">
                    {!!$errors->first('sector','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Dirección exacta</label>
                    <input type="text" required="true" name="direccion" class="form-control" id="direccion" placeholder="Brisas del Obelisco, calle principal">
                    {!!$errors->first('direccion','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Punto de referencia</label>
                    <input type="text" required="true" name="puntoReferencia" class="form-control" id=puntoReferencia" placeholder="Diagonal a carniceria chavezVive">
                    {!!$errors->first('puntoReferencia','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Código postal</label>
                    <input type="text" required="true" name="codigoPostal" class="form-control" id="codigoPostal" placeholder="3355">
                    {!!$errors->first('codigoPortal','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6">
                    <label>Número de Telefono 1</label>
  
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      </div>
                      <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                    </div>
                    <!-- /.input group -->
                  </div>

                  <div class="form-group col-md-6">
                    <label>Número de Telefono 2</label>
  
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      </div>
                      <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                    </div>
                    <!-- /.input group -->
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Observación</label>
                    
                    <textarea required="true" name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Ingrese una pequeña observación de su a cerca de su dirección"></textarea>
                    {!!$errors->first('observacion','<small>:message</small><br>')!!}
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Agregar dirección</button>
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