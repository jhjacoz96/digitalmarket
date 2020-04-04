@extends('layouts.appAdmin')
@section('contenido')
<div id="categoria">
  <form action="{{route('categoria.update',$categoria)}}" method="post">
    @csrf
    @method('PUT')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Categoría</h1>
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
                <h3 class="card-title">Actualizar categoría</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
            
                        <div class="card-body">
            
                        <span style="
                        display: none" id="editar">{{$editar}}</span>
                        <span style="
                        display: none"  id="nombretemp">{{$categoria->nombre}}</span>

                          <div class="form-group">
                            <label for="">Tipo de línea</label>
                            <select name="tipoLinea" id="tipoLinea" 
                            class="form-control"
                            required
                            >
                              <option value="">Seleccione una línea</option>
                          
                            @if ($categoria->tipoLinea=='Marrón')
                              <option value="Marrón" selected>Marrón</option>
                              <option value="Blanca">Blanca</option>
                            @else
                              <option value="Blanca" selected>Blanca</option>              <option value="Marrón">Marrón</option>    
                            @endif
                        
                               

                            </select>
                          </div>

                            <div class="form-group">
                                <label  for="">Nombre</label>
                                <input 
                                @blur="getCategoria"
                                @focus="divAparecer=true"
                            v-model="nombre" value="{{$categoria->nombre}}" class="form-control" name="nombre" id="nombre" type="text">
                            </div>

                            

                            <div class="form-group">
                                <label  for="">Slug</label>
                                <input readonly
                            v-model="generarSlug" class="form-control" value="{{$categoria->slug}}" name="slug" id="slug" type="text">
                                <div v-if="divAparecer" v-bind:class="divClaseSlug">
                                    @{{divMensajeSlug}}
                                </div>
                                <br v-if="divAparecer">
                            </div>


                            <div class="form-group">  
                                <label  for="">Descripcion</label>
                                <input class="form-control" name="descripcion" cols="30" rows="10" id="descripcion"  value="{{$categoria->descripcion}}"type="text">
                              
                        </div>
                            
                        </div>
                        <div class="card-footer">

                          <input 
                          :disabled="deshabilitarBoton==1"
                          class="btn btn-primary float-right" type="submit" value="Actualizar categoria"  >
                        </div>
                    
                    @{{slug}}
                
          
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
</form>
</div>
@endsection