@extends('layouts.appAdmin')
@section('contenido')
<div id="producto">
<form action="{{route('producto.store')}}" method="post" enctype="multipart/form-data">
    @csrf

<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <div class="p-2">
    @include('flash::message')
 </div>

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
      <h1>Producto</h1>
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


            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Datos generados automáticamente</h3>
      
                 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
      
                   <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
      
                        <label>Visitas</label>
                        <input  class="form-control" type="number" id="visitas" name="visitas">
      
                       
                      </div>
                      <!-- /.form-group -->
                      
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                      <div class="form-group">
      
                        <label>Ventas</label>
                        <input  class="form-control" type="number" id="ventas" name="ventas" >
                      </div>
                      <!-- /.form-group -->
          
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
      
      
      
      
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  
                </div>
              </div>
              <!-- /.card -->
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Datos del producto</h3>
      
                
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
      
                        <label>Nombre</label>
                        <input v-model="nombre" class="form-control" type="text" id="nombre" name="nombre"
                        @blur="getProducto"
                        @focus="divAparecer=true"
                        >
                        <label>Slug</label>
                        <input class="form-control" type="text" id="slug" name="slug" 
                        v-model="generarSlug"
                        >
                        <div v-if="divAparecer " v-bind:class="divClaseSlug">
                            @{{divMensajeSlug}}
                        </div>
                        <br v-if="divAparecer">
                       
                      </div>
                      <!-- /.form-group -->
                      
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                      <div class="form-group">
                        
                        <div class="row">
                          
                          <div class="col-md-6">
                          
                          <label>Categoria</label>
                          
                          <select v-model="selectedCategoria"  data-old="{{old('categoria_id')}}" @change="cargarSubCategorias" name="categoria_id" id="categoria_id" class="form-control select2" style="width: 100%;">
  
                              <option value=""  >Seleccione una categoria</option>
                              
                              @foreach($categoria as $categorias)
                              
                               @if ($loop->first)
                                  <option value="{{ $categorias->id }}">{{ $categorias->nombre }}</option>
                               @else
                                  <option value="{{ $categorias->id }}">{{ $categorias->nombre }}</option>
                                                             
                              @endif
                              @endforeach
          
          
                            </select>
                           
                         
                        </div>
                            <div class="col-md-6">
                             
                             
                          <label>Sub categoria</label>
                          
                            <select v-model="selectedSubCategoria" name="subCategoria_id" id="subCategoria_id" data-old="{{old('subCategoria_id')}}" class="form-control select2" style="width: 100%;">
  
                              <option value="" selected="selected" >Seleccione una categoria</option>
                              
                              <option v-for="(subCategoria,index) in obtenerSubCategorias" v-bind:value="index">@{{subCategoria}}</option>
          
                            </select>
                         
                          </div>

                        </div>
                        
                        <label>Cantidad</label>
                        <input class="form-control" type="number" id="cantidad" name="cantidad" >
                      </div>
                      <!-- /.form-group -->
          
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
      
      
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                 
              </div>
            </div>
      
              <!-- /.card -->
      
      
      
               <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Sección de Precios</h3>
      
                  
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
      
      
      
                    <div class="col-md-3">
                      <div class="form-group">
      
                        <label>Precio anterior</label>
                        
      
      
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">$</span>
                        </div>
                        <input class="form-control" type="number" id="precioanterior" name="precioanterior" min="0" value="0" step=".01">                 
                      </div>
                       
                      </div>
                      <!-- /.form-group -->
                      
                    </div>
                    <!-- /.col -->
      
      
      
                    <div class="col-md-3">
                      <div class="form-group">
      
                        <label>Precio actual</label>
                         <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">$</span>
                        </div>
                        <input class="form-control" type="number" id="precioactual" name="precioactual" min="0" value="0" step=".01">                 
                      </div>
      
                      <br>
                      <span id="descuento"></span>
                      </div>
                      <!-- /.form-group -->
          
                    </div>
                    <!-- /.col -->
      
      
      
      
                    <div class="col-md-6">
                      <div class="form-group">
      
                        <label>Porcentaje de descuento</label>
                         <div class="input-group">                  
                        <input class="form-control" type="number" id="porcentajededescuento" name="porcentajededescuento" step="any" min="0" min="100" value="0" >    <div class="input-group-prepend">
                          <span class="input-group-text">%</span>
                        </div>  
      
                      </div>
      
                      <br>
                      <div class="progress">
                          <div id="barraprogreso" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                      </div>
                      </div>
                      <!-- /.form-group -->
                      
                    </div>
                    <!-- /.col -->
      
      
                  </div>
                  <!-- /.row -->
      
      
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  
                </div>
              </div>
              <!-- /.card -->
      
      
      
      
      
      
      
      
         <div class="row">
                <div class="col-md-6">
      
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Descripciones del producto</h3>
                    </div>
                    <div class="card-body">
                      <!-- Date dd/mm/yyyy -->
                      <div class="form-group">
                        <label>Descripción corta:</label>
      
                        <textarea class="form-control" name="descripcion_corta" id="descripcion_corta" rows="3"></textarea>
                      
                      </div>
                      <!-- /.form group -->
      
                     <div class="form-group">
                        <label>Descripción larga:</label>
      
                        <textarea class="form-control" name="descripcion_larga" id="descripcion_larga" rows="5"></textarea>
                      
                      </div>                
      
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
      
             </div>
              <!-- /.col-md-6 -->
      
      
      
      
                <div class="col-md-6">
      
                  <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Especificaciones y otros datos</h3>
                    </div>
                    <div class="card-body">
                      <!-- Date dd/mm/yyyy -->
                      <div class="form-group">
                        <label>Especificaciones:</label>
      
                        <textarea class="form-control" name="especificaciones" id="especificaciones" rows="3"></textarea>
                      
                      </div>
                      <!-- /.form group -->
      
                     <div class="form-group">
                        <label>Datos de interes:</label>
      
                        <textarea class="form-control" name="datos_de_interes" id="datos_de_interes" rows="5"></textarea>
                      
                      </div>                
      
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
      
             </div>
              <!-- /.col-md-6 -->
      
      
      
            </div>
            <!-- /.row -->
      
      
      
      
               <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">Imagenes</h3>
      
                 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
      
                  <div class="form-group">
                      
                     <label for="archivosimagenes">Subir varias imagenes</label> 
                                    
                     <input type="file" class="form-control-file" id="archivosimagenes[]" multiple 
                     accept="image/*" >
                  </div>
      
      
                </div>
      
      
                <!-- /.card-body -->
                <div class="card-footer">
                  
                </div>
              </div>
              <!-- /.card -->
      
      
            <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">Administración</h3>
                </div>
                <!-- /.card-header -->
            <div class="card-body">
      
             <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
      
                        <label>Estado</label>
                        <input  class="form-control" type="text" id="estado" name="estado" value="Nuevo">
      
                       
                      </div>
                      <!-- /.form-group -->
                      
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                          <!-- checkbox -->
                          <div class="form-group clearfix">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="activo" name="activo">
                              <label class="custom-control-label" for="activo">Activo</label>
                           </div>
      
                          </div>
      
                          <div class="form-group">
                          <div class="custom-control custom-switch">
                            <input type="checkbox"  class="custom-control-input" id="sliderprincipal" name="sliderprincipal">
                            <label class="custom-control-label" for="sliderprincipal">Aparece en el Slider principal</label>
                          </div>
                        </div>
      
                        </div>
      
                      
      
             </div>
                  <!-- /.row -->
      
      
      
      
             <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
      
                         <a class="btn btn-danger" href="">Cancelar</a>
                         <input  
                         :disabled="deshabilitarBoton==1"        
                        type="submit" value="Guardar" class="btn btn-primary">
                       
                      </div>
                      <!-- /.form-group -->
                      
                    </div>
                    <!-- /.col -->
      
      
                 
                      
      
             </div>
                  <!-- /.row -->
      
      
      
      
                </div>
      
      
         
                <!-- /.card-body -->
                <div class="card-footer">
                  
                </div>
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