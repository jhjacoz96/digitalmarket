@extends('layouts.appAdmin')
<script>
window.data={
    editar:'si',
    datos:{
        "envioGratis":"{{$envio->envioGratis}}",
        "precio0kg30kg":"{{$envio['0kgA30kg']}}",
        "precio31kg50kg":"{{$envio['31kgA50kg']}}",
        "precio51kg100kg":"{{$envio['50kgA100kg']}}",
        "precio101kg200kg":"{{$envio['101kgA200kg']}}",
        "precio201kg":"{{$envio['mayorA201kg']}}",
        "envioGratisMonto":"{{$envio->envioGratisApartir}}"
    }

}
</script>
@section('contenido')
<div id="metodoEnvio">
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
                <h3 class="card-title">Actualizar plan de afiliación</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('metodoEnvio.update',$envio)}}" method="post" id="quickForm">
                @method('PUT')
                @csrf
                <div class="card-body">

                  
                  

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Rango del envío</label>
                    <select name="alcance" class="form-control"  id="">

                      <option 
                      @if($envio->dentroIribarren=='no')
                      selected
                      @endif
                         value="nacional">Todo el territo nacional</option>
                      <option
                      @if($envio->dentroIribarren=='si')
                      selected
                      @endif
                      value="iribarren">Solo barquisimeto</option>
                    </select>
                    {!!$errors->first('alcance','<small>:message</small><br>')!!}

                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Nombre</label>
                  <input type="text" required="true" value="{{$envio->nombre}}" name="nombre" class="form-control" id="nombre" placeholder="">
                    {!!$errors->first('nombre','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6">
                    <label for="">Tiempo de entrega</label>
                    <input  class="form-control" value="{{$envio['tiempoEntrega']}}"  name="tiempoEntrega"  type="text">
                    {!!$errors->first('tiempoEntrega','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-switch ">
                      <input type="checkbox" 
                     
                      class="custom-control-input" id="envioGratis"   v-model="envioGratis"
                       name="envioGratis">
                      <label class="custom-control-label" for="envioGratis">Envio gratis</label>
                    </div>
                  </div>

                  <div class="form-group" v-if="envioGratis==false">
                    <div class="custom-control custom-switch ">
                      <input type="checkbox" 
                      
                      class="custom-control-input" id="envioGratisMonto"   v-model="envioGratisMonto"
                      name="envioGratisMonto">
                      <label class="custom-control-label" for="envioGratisMonto">Envío gratis a partir de un monto</label>
                    </div>
                  </div>

                  <div class="form-group col-md-6" v-if="envioGratisMonto==true">
                    <label for="exampleInputEmail1">Monto mínimo a aplicar</label>
                  <input type="text" required="true" v-model="montoMinimo" name="montoMinimo" class="form-control" id="montoMinimo" placeholder=""> 
                    {!!$errors->first('montoMinimo','<small>:message</small><br>')!!}
                  </div>
                  

                  <div class="form-group col-md-6" v-if="envioGratis==false">
                    <label for="">Precio de envio de 0kg a 30kg</label>
                    <input  class="form-control"  v-model="precio0kg30kg" placeholder="" name="precio0kg30kg"  type="text">
                    {!!$errors->first('precio0kga30','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6" v-if="envioGratis==false">
                    <label for="">Precio de envio de 31kg a 50kg</label>
                    <input  class="form-control"  v-model="precio31kg50kg" placeholder="" name="precio31kg50kg"  type="text">
                    {!!$errors->first('precio31kga50','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6" v-if="envioGratis==false">
                    <label for="">Precio de envio de 51kg a 100kg</label>
                    <input  class="form-control"  v-model="precio51kg100kg" placeholder="" name="precio51kg100kg"  type="text">
                    {!!$errors->first('precio51kg50kg','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6" v-if="envioGratis==false">
                    <label for="">Precio de envio de 101kg a 200kg</label>
                    <input  class="form-control"  v-model="precio101kg200kg" placeholder="" name="precio101kg200kg"  type="text">
                    {!!$errors->first('precio101kga200','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6" v-if="envioGratis==false">
                    <label for="">Precio de envio con mas de 201kg</label>
                    <input  class="form-control"  v-model="precio201kg" placeholder="" name="precio201kg"  type="text">
                    {!!$errors->first('precio200kg','<small>:message</small><br>')!!}
                  </div>

              

                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox"
                      @if($envio->status)
                      checked
                      @endif
                      class="custom-control-input" id="activo" name="activo">
                      <label class="custom-control-label" for="activo">Activo</label>
                    </div>
                  </div>

                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit"  class="btn btn-primary float-right">Actualizar metodo de envio</button>
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