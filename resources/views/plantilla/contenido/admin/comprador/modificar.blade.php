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
          <li class="breadcrumb-item active">Actualizar </li>
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
                <h3 class="card-title">Actualizar comprador</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('Comprador.update',$comprador)}}" method="post" id="quickForm">
                @method('PUT')
                @csrf
                
                <div class="card-body">

                  <div class="form-group col-md-6" >
                    <label for="exampleInputEmail1">Nombre</label>
                <input type="text" required="true" name="nombre" value="{{$comprador->nombre}}" class="form-control" id="nombre" placeholder="Ingrese su nombre">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Apellido</label>
                    <input type="text" required="true" value="{{$comprador->apellido}}"
                    name="apellido" class="form-control" id="apellido" placeholder="Ingrese su apellido">
                  </div>
                
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Correo electrónico</label>
                    <input type="text" required="true" name="correo" class="form-control" value="{{$comprador->correo}}"id="correo" placeholder="Ingrese un correo electrónico">
                    {!!$errors->first('correo','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6">
                    <label for="">Asignar a un tipo de cliente</label>
                    <select class="form-control" name="tipoComprador" id="">
                      <option value="" selected>Seleccione un tipo</option>
                      @foreach ($tipo as $tipoc)
                      @if ($tipoc->id==$comprador->tipoComprador_id)
                        <option value="{{$tipoc->id}}" selected>{{$tipoc->nombre}}</option>
                      @else
                        <option value="{{$tipoc->id}}">{{$tipoc->nombre}}</option>
                      @endif
                      @endforeach

                    </select>
                    {!!$errors->first('tipoComprador','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group">
                      
                    <div class="custom-control custom-switch">
                      <input type="checkbox"  class="custom-control-input" 
                      @if ($comprador->estatus=='A')
                          checked
                      @endif
                      id ="activo" name="activo">
                      <label class="custom-control-label" for="activo">Activo</label>
                    </div>
                  </div>

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