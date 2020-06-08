@extends('layouts.appAdmin')
@section('estilos')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
 
    <script>
       $( function() {
         $( "#datepicker" ).datepicker({
           minDate:0,
           dateFormat:'yy-mm-dd'
          });
        });
    </script>
    <script>
     window.data={
       editar:'no'
     }
    </script>
@endsection

@section('contenido')
<div id="cupon">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Cupón</h1>
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
                <h3 class="card-title">Agregar cupón</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('cupon.store')}}" method="post"  enctype="multipart/form-data" id="quickForm">
                @csrf
                <div class="card-body">

                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Código de cupón</label>
                      <div class="d-flex">
                        <input type="text" required="true" name="codigo" class="form-control" v-model="codigo" >
                        <button type="button" @click.prevent="generarCodigo()" class="btn btn-sm btn-default ml-1">Generar</button>
                      </div>

                      {!!$errors->first('codigo','<small>:message</small><br>')!!}
  
                    </div>


                    <div class="form-group col-md-6" >
                      <label for="">Asignar a tipos de compradores</label>
                      <select multiple name="tipo[]" id=""  class="form-control">
                        @foreach($tipoComprador as $item)    
                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                        @endforeach
                      </select>
                      {!!$errors->first('tipo','<small>:message</small><br>')!!}
                    </div>
              
                    <div class="form-group col-md-6">
                      <label for="">Tipo de cupón</label>
                      <select v-model="tipoCupon" @change="obtenerTipoCupon" class="form-control" name="tipoCupon" >
                        <option value="" selected>Seleccione un tipo</option>
                        <option value="Porcentaje" >Porcentaje</option>
                        <option value="MontoFijo" >Monto fijo</option>
                        
  
                      </select>
                      {!!$errors->first('tipoCupon','<small>:message</small><br>')!!} 
                    </div>
                    
                    <div v-if="tipoCupon" class="form-group col-md-6">
                    <label for="exampleInputEmail1">@{{tipoCantidad}}</label>
                      <input type="number" v-model.number="cantidad" required="true" name="cantidad" class="form-control"  >
                      {!!$errors->first('cantidad','<small>:message</small><br>')!!}
  
                    </div>
                    @{{generarCantidad}}
                    


                  <div class="form-group col-md-6">
                    <label>Fecha de expiración</label>
  
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control float-right" name="fechaExpiracion" id="datepicker">
                    </div>
                    <!-- /.input group -->
                    {!!$errors->first('fechaExpiracion','<small>:message</small><br>')!!}  
                  </div>
                
                  <div class="form-group">
                      
                    <div class="custom-control custom-switch">
                      <input type="checkbox" name="estatus"  class="custom-control-input" id ="activo" name="activo">
                      <label class="custom-control-label" for="activo">Activo</label>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <a href="{{route('cupon.index')}}" class="btn btn-secondary float-left">Atrás</a>
                  <button type="submit" class="btn btn-primary float-right">Agregar cupón</button>
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
