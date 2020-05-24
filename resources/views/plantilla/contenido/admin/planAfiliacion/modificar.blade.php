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
            <li class="breadcrumb-item active">Actualizar</li>
          </ol>

      </div>
    </div>
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
                <h3 class="card-title">Actualizar plan de afiliación</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('Plan.update',$plan)}}" method="post" id="quickForm">
                @method('PUT')
                @csrf
                <div class="card-body">

                  
                  

                  <div class="form-group">
                    <label for="exampleInputEmail1">Descripción</label>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" required="true" name="nombre"
                    @if($plan->nombre=='Gratuita'||$plan->nombre=='gratuita')
                    readonly
                    @endif
                    value="{{$plan->nombre}}" class="form-control" id="nombre" placeholder="Premium">
                      {!!$errors->first('nombre','<small>:message</small><br>')!!}
  
                    </div>
  
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1" >Exposición en el listado</label>
                      <select name="exposicion" class="form-control" id="">
                        <option value="">Seleccione un nivel</option >
                         
                          @if($plan->exposicion=='Maxima')
                          <option value="Maxima" selected="selected">Maxima</option>
                          <option value="Alta" >Alta</option>
                          <option value="Baja" >Baja</option>
                          @endif
                          @if($plan->exposicion=='Alta')
                          <option value="Maxima" >Maxima</option>
                          <option value="Alta" selected="selected">Alta</option>
                          <option value="Baja" >Baja</option>
                          @endif
                          @if($plan->exposicion=='Baja')
                          <option value="Maxima">Maxima</option>
                          <option value="Alta">Alta</option>
                          <option value="Baja" selected="selected">Baja</option>

                          @endif
                         
                      </select>
                    </div>
  
                    <div class="form-group col-md-6">
                      <label for="">Maximo de stock por publicacion</label>
                      <input  class="form-control" 
                      @if($plan->tiempoPublicacion=='Ilimitado')
                      value=""
                      @else
                      value=" {{$plan->tiempoPublicacion}}"
                      @endif
                      {{$plan->tiempoPublicacion}}
                       placeholder="60" name="tiempoPublicacion"  type="text">
                       <small>(Si deja este campo vacio, el stock será ilimitado)</small>
                    </div>
  
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Descripción</label>
                      
                      <textarea required="true" name="descripcion" id="descripcion" class="form-control" rows="3" laceholder="Descripción corta">{!!$plan->descripcion!!}
                      </textarea>
                      {!!$errors->first('descripcion','<small>:message</small><br>')!!}
                    </div>
  
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Porcentaje de costo por venta (Porcentaje)</label>
                      <input type="text" required="true" value="{{$plan->precio}}" name="porcentaje" class="form-control" id="porcentaje"  placeholder="10">
                      {!!$errors->first('porcentaje','<small>:message</small><br>')!!}
                    </div>
  
  
  
                    <div class="form-group col-md-6">
                      <label for="">Cantidad de publicaciones activas</label>
                      <input  class="form-control" type="text" 
                      @if($plan->cantidadPublicacion=='Ilimitado')
                      value=""
                      @else
                      value="{{$plan->cantidadPublicacion}}"
                      @endif
                      name="cantidadPublicacion" placeholder="2">
                      <small>(Si deja este campo vacio, la canidad será ilimitada)</small>
                    </div>
  
                    <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox"
                        @if($plan->estatus=='A')
                        checked
                        @endif
                        class="custom-control-input" id="activo" name="activo">
                        <label class="custom-control-label" for="activo">Activo</label>
                      </div>
                    </div>

                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit"  class="btn btn-primary float-right">Actualizar Plan de afiliación</button>
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