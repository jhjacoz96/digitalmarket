@extends('layouts.appAdmin')
@section('contenido')
<div class="metodoPago">


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Banco para medio de pago</h1>
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
                <h3 class="card-title">Agregar banco</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('bancoMetodoPago.store')}}" method="post" id="quickForm">
                @csrf
                <div class="card-body">

                  

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Nombre del banco*</label>
                    <input type="text" required="true" name="nombreBanco" class="form-control" id="nombreBanco">
                    {!!$errors->first('nombreBanco','<small>:message</small><br>')!!}

                </div>

                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Detalle de la cuenta*</label>
                    <input type="text"  name="detalleCuenta" class="form-control" id="detalleCuenta"  >
                    {!!$errors->first('detalleCuenta','<small>:message</small><br>')!!}
                </div>

                

                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Documento de identidad</label>
                    <div class="d-flex">
                        <select name="tipo" class="form-control col-3" id="" >
                            <option value="" selected>Seleccione una opción</option>
                            <option  value="V-">V-Venezolano</option>
                            <option value="P-">P-Pasaporte</option>
                            <option value="E-">E-Extranjero</option>
                            <option value="J-">J-Jurídico</option>
                            <option value="R-">R-Firmas Personales</option>
                            <option value="O">O-Organización Comunal</option>
                        </select>
                    <input type="text" name="documentoIdentidad" class="form-control ml-1" id="documentoIdentidad"  >
                    </div>

                </div>


                  <div class="form-group col-md-6">
                    <label for="">Titular de la cuenta</label>
                    <input  class="form-control" type="text" name="titularCuenta" >
                  </div>

                  <div class="form-group col-md-6">
                    <label for="">Tipo cuenta</label>
                    <input  class="form-control" type="text" name="tipoCuenta" >
                  </div>

                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <a class="btn btn-secondary" href="{{route('bancoMetodoPago.index')}}">Atras</a>
                  <button type="submit"  class="btn btn-primary float-right">Agregar banco</button>
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
