@extends('layouts.appAdmin')

@section('scripts')
<script>
    window.data={
      
        editar:'no'
            
      }
</script>
@endsection

@section('contenido')
<div id="direccion">

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
                    <input type="email" required="true" name="correo" v-model="correo" class="form-control" id="correo"
                    @blur="getComprador"
                    @focus="divAparecer=false"
                    placeholder="Ingrese un correo válido">
                    {!!$errors->first('correo','<small>:message</small><br>')!!}
                  </div>
                  <div v-if="divAparecer " v-bind:class="divClaseSlug">
                    @{{divMensajeSlug}}
                </div>
                <br v-if="divAparecer">
                <br>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" required="true" name="nombre" class="form-control" id="nombre" placeholder="Jhon" v-model="nombre">
                    {!!$errors->first('nombre','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Apellido</label>
                    <input type="text" required="true" name="Apellido" v-model="apellido" class="form-control" id="apellido" placeholder="Contreras">
                    {!!$errors->first('apellido','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group col-md-6">
                    <label for="">Seleccione un estado</label>
                    <select class="form-control" id="estado_id" v-model='estado_id' @change="getMunicipio()" name="estado_id" >
                      <option value="" selected >Seleccione un estado</option>
                    <option :value="estado.id" v-for="(estado, index) in estados" >@{{estado.nombre}}</option>
                    </select>
                  </div>
                  
                  <div class="form-group col-md-6">
                    <label for="">Seleccione un municipio</label>
                    <select class="form-control" id="municipio_id" v-model="municipio_id" @change="getParroquia()" name="municipio_id">
                      <option value="" selected>Seleccione un municipio</option>
                    <option :value="municipio.id" v-for="(municipio,index ) in municipios" >@{{municipio.nombre}}</option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="">Seleccione una parroquia</label>
                    <select class="form-control" id="parroquia_id" @change="getZona()" v-model="parroquia_id"  name="parroquia_id">
                      <option value="" selected>Seleccione una parroquia</option>
                    <option :value="parroquia.id" v-for="(parroquia,index ) in parroquias" >@{{parroquia.nombre}}</option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="">Seleccione una zona</label>
                    <select class="form-control" id="zona_id" v-model="zona_id" @change="getCodigo()"   name="zona_id">
                      <option value="" selected>Seleccione una zona</option>
                    <option :value="zona.id" v-for="(zona,index ) in zonas" >@{{zona.nombre}}</option>
                    </select>
                  </div>
               
        
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Código postal</label>
                    <input type="text" readonly required="true" name="codigoPostal" class="form-control" v-model="codigoPostal" placeholder="3355">
                    {!!$errors->first('codigoPortal','<small>:message</small><br>')!!}
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
                    <label>Número de Telefono 1</label>
  
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      </div>
                      <input type="text" required="true" name="primerTelefono" class="form-control"  placeholder="Primero telefono">
                      {!!$errors->first('primerTelefono','<small>:message</small><br>')!!}
                    </div>
                    <!-- /.input group -->
                  </div>

                  <div class="form-group col-md-6">
                    <label>Número de Telefono 2</label>
  
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      </div>
                      <input type="text" required="true" name="segundoTelefono" class="form-control"  placeholder="Segundo telefono">
                    {!!$errors->first('segundoTelefono','<small>:message</small><br>')!!}
                    </div>
                    <!-- /.input group -->
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Observación</label>
                    
                    <textarea  name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Ingrese una pequeña observación de su a cerca de su dirección"></textarea>
                    {!!$errors->first('observacion','<small>:message</small><br>')!!}
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                  <a class="btn btn-secondary float-left" href="{{route('direccion.index')}}">Atrás</a>

                  <button type="submit" :disabled='deshabilitarBoton==1' class="btn btn-primary float-right">Agregar dirección</button>
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