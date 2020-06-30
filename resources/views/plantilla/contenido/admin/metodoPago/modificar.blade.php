@extends('layouts.appAdmin')
@section('contenido')
<div id="metodoEnvio">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Medio pago</h1>
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
                <h3 class="card-title">Actualizar medio pago</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('metodoPago.update',$banco)}}" method="post" id="quickForm">
                @method('PUT')
                @csrf
                <div class="card-body">

                  
                  
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Nombre*</label>
                    <input type="text" required="true" name="nombre" value="{{$banco->nombre}}" class="form-control" id="nombre" placeholder="">
                        {!!$errors->first('nombre','<small>:message</small><br>')!!}
                      </div>
    
                      <div class="form-group col-md-6 ">
                        <label for="">Tipo de metodo de pago*</label>
                        <select name="tipoMetodo" class="form-control" id="">
                            <option value="">Seleccione una opción</option>
                            
                            <option 
                            @if ($banco->tipoPago=='Transferencias en moneda nacional')
                                selected
                            @endif
                            value="nacional">Transferencias en moneda nacional</option>
                            <option
                            @if ($banco->tipoPago=='internacional')
                                selected
                            @endif
                            value="internacional">Transferencias en moneda Internacional</option>
                        </select>
                      </div>
    
                      <div class="form-group col-md-6 ">
                        <label for="">Moneda*</label>
                        <select name="moneda" class="form-control" id="">
                            <option value="">Seleccione una opción</option>
                            <option 
                            @if ($banco->moneda=='Bolivares')
                                selected
                            @endif
                            value="Bolivares">Bolivares</option>
                            <option
                            @if ($banco->moneda=='Dolar')
                                selected
                            @endif
                            value="Dolar">Dolar</option>
                        </select>
                      </div>

                      <div class="form-group col-md-6">
                        <label for="">Asociar una cuenta bancaria a este metodo de pago</label>
                        <select name="bancoMetodoPago" class="form-control" id="">
                            <option value="">Seleccione una cuenta</option>
                            @foreach ($cuenta as $item)
                        <option 
                        @if ($banco->id==$item->id)
                            selected
                        @endif
                        value="{{$item->id}}">{{$item->nombreBanco}}-{{$item->detalleCuenta}}</option>
                            @endforeach
                        </select>
                      </div>
    
                      <div class="form-group col-md-6">
                        <label for="">Telefono</label>
                      <input  class="form-control" placeholder="" value="{{$banco->telefono}}" name="telefono"  type="text">
                      </div>
    
                      <div class="form-group col-md-6">
                        <label for="">Correo electrónico</label>
                        <input
                        value="{{$banco->correo}}"
                        class="form-control" placeholder="" name="correo"  type="text">
                      </div>
    
                      
    
    
                      <div class="form-group col-md-6">
                        <label for="">Descipción</label>
                        <input  class="form-control" placeholder="" name="descripcion"  type="text">
                      </div>

                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a class="btn btn-secondary" href="{{route('metodoPago.index')}}">Atras</a>

                  <button type="submit"  class="btn btn-primary float-right">Actualizar medio de pago</button>
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