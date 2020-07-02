@extends('layouts.appAdmin')
@section('contenido')
<div id="metodoEnvio">
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
            <li class="breadcrumb-item active">Actualizar</li>
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
                <h3 class="card-title">Actualizar banco</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('bancoMetodoPago.update',$banco)}}" method="post" id="quickForm">
                @method('PUT')
                @csrf
                <div class="card-body">

                  
                  

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Nombre del banco*</label>
                    <input type="text" required="true" name="nombreBanco" class="form-control" id="nombreBanco" value="{{$banco->nombreBanco}}" >
                        {!!$errors->first('nombreBanco','<small>:message</small><br>')!!}
    
                    </div>
    
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Detalle de la cuenta*</label>
                        <input type="text" value="{{$banco->detalleCuenta}}"  name="detalleCuenta" class="form-control" id="detalleCuenta"  >
                        {!!$errors->first('detalleCuenta','<small>:message</small><br>')!!}
                    </div>
    
                    
    
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Documento de identidad</label>
                        <div class="d-flex">
                            <select name="tipo" class="form-control col-3" id="" required >
                                <option value="" >Seleccione una opción</option>
                                <option 
                                @if ($banco->tipoDocumento=='V-' )
                                    selected
                                @endif
                                value="V-">V-Venezolano</option>
                                <option 
                                @if ($banco->tipoDocumento=='P-' )
                                    selected
                                @endif
                                value="P-">P-Pasaporte</option>
                                <option 
                                @if ($banco->tipoDocumento=='E-' )
                                    selected
                                 @endif
                                value="E-">E-Extranjero</option>
                                <option 
                                @if ($banco->tipoDocumento=='J-' )
                                    selected
                                 @endif
                                value="J-">J-Jurídico</option>
                                <option 
                                @if ($banco->tipoDocumento=='R-' )
                                    selected
                                 @endif
                                value="R-">R-Firmas Personales</option>
                                <option 
                                @if ($banco->tipoDocumento=='O-' )
                                    selected
                                 @endif
                                value="O-">O-Organización Comunal</option>
                            </select>
                        <input type="text" name="documentoIdentidad" class="form-control ml-1" id="documentoIdentidad" value="{{$banco->documentoIdentidad}}"  placeholder="26378059">
                        </div>
    
                    </div>
    
    
                      <div class="form-group col-md-6">
                        <label for="">Titular de la cuenta</label>
                      <input  class="form-control" type="text" name="titularCuenta" value="{{$banco->titular}}">
                      </div>
    
                      <div class="form-group col-md-6">
                        <label for="">Tipo cuenta</label>
                      <input  class="form-control" type="text" name="tipoCuenta" value="{{$banco->tipoCuenta}}"
                       >
                      </div>

                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a class="btn btn-secondary" href="{{route('bancoMetodoPago.index')}}">Atras</a>

                  <button type="submit"  class="btn btn-primary float-right">Actualizar banco</button>
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