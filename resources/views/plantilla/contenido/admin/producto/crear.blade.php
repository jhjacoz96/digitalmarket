@extends('layouts.appAdmin')

@section('estilos')
<!--<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">-->
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

@endsection

@section('scripts')
<!--<script src="https://unpkg.com/vue-multiselect@2.1.0"></script>-->
<script src="/adminlte/ckeditor/ckeditor.js"></script>

<!-- select2---->
<script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>


<script>

  window.data={
    editar:'no',
    datos:{
      "rol":"{{$rol}}"
    }
  }

  
  $(function () {
      //Initialize Select2 Elements
      $('#categoriaa_id').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
  
  </script>

@endsection

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


              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Datos del producto</h3>
      
                
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    
                    <div class="callout callout-info">
                      <h5>Tipos de producto</h5>
    
                      <p>Puede elegir entre dos tipos de productos:<p> <p></a><strong>Común</strong>, solo podrá indicar una  cantidad de produtos de forma general.</p>
                      <p><strong>Variantes de atributos</strong>, Las combinaciones son las diferentes variaciones de un producto, con atributos como su tamaño, peso o color que toman diferentes valores. ¿Su producto requiere combinaciones?.</p>
                    </div>

                    <div class="col-md-6">
                      
                      <div class="form-group">
                        <label for="">Seleccione un tipo de producto</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input"  @click="tipoProd()" v-bind:value="tipoProducto" type="radio" id="customRadio1" name="tipoProd">
                          <label for="customRadio1" class="custom-control-label">Producto común</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio2" v-bind:value="tipoProducto" name="tipoProd" @click="tipoProd()">
                          <label for="customRadio2" class="custom-control-label">Producto con variación de atributos</label>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
      
                        <label>Código de la tienda</label>
                        <input  class="form-control" type="text" id="tienda" name="tienda" 
                        @blur="obtenerTienda"
                        @focus="divAparecerTienda=true"
                        v-model="tienda" >
                        <div v-if="divAparecerTienda " v-bind:class="divClaseTienda">
                          @{{divMensajeTienda}}
                      </div>
                      <br v-if="divAparecer">
                        {!!$errors->first('tienda','<small>:message</small><br>')!!}
                       
                      </div>
                      <!-- /.form-group -->
                      
                    </div>
                    

                    <div class="col-md-6">


                      <div class="form-group">
      
                        <label>Nombre</label>
                        <input v-model="nombre" class="form-control" type="text"  name="nombre"
                        @blur="getProducto"
                        @focus="divAparecer=true"
                        >
                        {!!$errors->first('nombre','<small>:message</small><br>')!!}
                        <label>Slug</label>
                        <input class="form-control" type="text" id="slug" name="slug" 
                        readonly
                        v-model="generarSlug" 
                        >
                        <div v-if="divAparecer " v-bind:class="divClaseSlug">
                            @{{divMensajeSlug}}
                        </div>
                        <br v-if="divAparecer">
                        {!!$errors->first('slug','<small>:message</small><br>')!!}
                      </div>
                      <!-- /.form-group -->
                      
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                      <div class="form-group">
                        
                        <div class="row">
                          
                          <div class="col-md-6">
                          
                          <label>Categoria</label>
                          
                          <select  v-model="selectedCategoria"  data-old="{{old('categoria_id')}}" @change="cargarSubCategorias" name="categoria_id" id="categoria_id" class="form-control" style="width: 100%;">
  
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
                              
                              <option v-for="(subCategoria,index) in obtenerSubCategorias" v-bind:value="subCategoria.id">@{{subCategoria.nombre}}</option>

                            </select>
                         
                          </div>

                        </div>
                        
                        <div class="form-group" v-if="tipoProducto!='combinacion'">
                          <label>Cantidad</label>
                          <input class="form-control"  type="number" id="cantidad"  name="cantidad" value="0" >
                        </div>

                      </div>
                      <!-- /.form-group -->
                      
                      

                    </div>

                    <div class="col-md-6">

                      <div class="form-group">
                        <label for="">Marca</label>
                        <select class="form-control" name="marca" >
                          <option value="" selected>Seleccione una marca</option>
                          @foreach ($marca as $item)   
                            <option value="{{$item->id}}" >{{$item->nombre}}</option>
                          @endforeach
                        </select>
                      </div>
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

              
              <div class="card card-secondary" v-if="tipoProducto=='combinacion'">
                                
                <div class="card-header">
                    <h3 class="card-title">Combinaciones</h3>
                </div>
                <div class="card-body">

                  <div class="callout callout-info">
    
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fas fa-bullhorn"></i>
                        Imporfacion importante
                      </h3>
                    </div>
          
                    <h5></h5>
          
                    <p>  Para agregar combinaciones, primero debe crear grupos de atributos y atributos adecuados en <a href="{{route('grupoAtributo.index')}}">Grupos de atributos</a> .
                      Cuando termine, puede ingresar los atributos deseados (como "tamaño" o "color") y sus respectivos valores ("10kg", "rojo", etc.) en el campo a continuación; o simplemente selecciónelos de la columna derecha. Luego haga clic en "Generar": ¡creará automáticamente todas las combinaciones para usted!</p>
                  </div>
               
                  <div class="row">
                    @{{value}}
                    <br>
                    @{{listaCombinacion}}
                    <div class="col-md-4">
                     
                          <div class="form-group" v-for="(item,index) in grupos">
                            <label for="">@{{item.nombre}}</label>
                            <!--<select v-model="select"   class="form-control"  multiple   >
                            <option   :value="items" v-for="(items,index) in item.atributo">@{{items.nombre}}</option>
                            </select>-->
                            <vue-multiselect v-model="select" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="nombre" track-by="id"      
                            :options="item.atributo"
                            :multiple="true" :taggable="true" @tag="addTag"></vue-multiselect>
                          </div>
                         
                    </div>
                    <div class="col-md-8">
  
                        <div class="form-group">
                            
                            <button type="button" class="btn btn-secondary float-right" v-on:click="generarLista()">
                                combinar
                            </button>
    
                            <button type="button" class="btn btn-outline-secondary float-left " v-if="aparecer" v-on:click.prevent="reset">
                                resetear
                            </button>
                           
                        </div>
                        
                        <input type="hidden" v-model="value" name="value">
                        
    
                        <div class="card-body table-responsive p-0" v-if="aparecer">
                            <table class="table table-hover"  >
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Variante</th>
                                        <th scope="col">Cantidad</th>
                                      
    
    
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="( items, index) in listaCombinacion"  :key="index"  >
    
                                        <td scope="row">@{{index+1}}</td>
    
                                        <td>
                                            <div v-for="(item, index) in items.elemento" :key="index">
                                               @{{item.nombre}}
                                            </div>
                                        </td>
    
                                        <td>
                                            <input v-model="items.cantidad" class="col-md-4" type="text">
                                        </td>
    
                                        
    
                                        <td>
    
                                            <a href="" @click.prevent="eliminarCombinacion(items,index)">
                                                <i class="fas fa-trash-alt" style="color:red;"></i>
                                            </a>
    
    
                                        </td>
    
                                    </tr>
    
                                    
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                 
                
                </div>
                
                <div class="card-footer">
                        
                        <button v-on:click.prevent="convertir()" class="btn btn-primary" type="button" >
                            formato
                        </button>
                    
                </div>
           
            </div>




     
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Sección de Precio</h3>
      
                  
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-6">
                      <label for="">Precio  del producto</label>
                      <input 
                        v-model.numer="precioAnterior"
                        class="form-control" type="number" id="precioAnterior" name="precioAnterior" min="0" value="0" step=".01"> 
                    </div>
                  </div>

                  <div class="row my-4">
                   <div class="col-md-12">
                    <p class="lead">Aplicar descuento</p>
                    <hr>
                  </div>
                    <div class="col-md-3">
                      <div class="form-group">
      
                        <label>Precio anterior</label>
                        
      
      
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">$</span>
                        </div>
                        <input 
                        v-model.numer="precioAnterior" readonly
                        class="form-control" type="number"  min="0" value="0" step=".01">                 
                      </div>
                       
                      </div>
                      <!-- /.form-group -->
                      
                    </div>
                    <!-- /.col -->
      
      
      
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Precio con descuento</label>
                         <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">$</span>
                        </div>
                        <input
                        v-model.numer="precioActual" readonly
                        class="form-control" type="number" id="precioActual" name="precioActual" min="0" value="0" step=".01">                 
                      </div>
      
                      <br>
                      <span id="descuento">
                          @{{generarDescuento}}
                      </span>
                      </div>
                      <!-- /.form-group -->
          
                    </div>
                    <!-- /.col -->
      
      
      
      
                    <div class="col-md-6">
                      <div class="form-group">
      
                        <label>Porcentaje de descuento</label>
                         <div class="input-group">                  
                        <input 
                        v-model.numer="porcentajeDescuento"
                        class="form-control" type="number" id="porcentajeDescuento" name="porcentajeDescuento" step="any" min="0" max="100" value="0" >    <div class="input-group-prepend">
                          <span class="input-group-text">%</span>
                        </div>
      
                      </div>
      
                      <br>
                      <div class="progress">
                          <div id="barraprogreso" class="progress-bar" role="progressbar" 

                          v-bind:style="{width:porcentajeDescuento+'%'}"

                          aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">@{{porcentajeDescuento}}%</div>
                      </div>
                      </div>
                      <!-- /.form-group -->
                      
                    </div>

                    
                    </div>
                  <!-- /.row -->

                  
                <!--
                  <div class="row">
                    <div class="col-md-12">
                   <p class="lead">Precio específico</p>
                      <hr>
                
                  </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="">Mínimo de unidades</label>
                        <input type="text" value="1" class="form-control">  
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="">Precio</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                          </div>
                          <input 
                          class="form-control" type="number" min="0" value="0" step=".01">                 
                        </div>  
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Tipos compradores</label>
                        <select name="" class="form-control" id="">
                          <option value="">Seleccione un tipo comprador</option>
                        </select>
                      </div>
                    </div>

                  </div>
                -->

      
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  
                </div>
              </div>
      
      
      
              
      
      
      
      
         <div class="row">
                <div class="col-md-6">
      
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Descripciones del producto</h3>
                    </div>
                    <div class="card-body">
                      <!-- Date dd/mm/yyyy -->
                      <div class="form-group">
                        <label>Descripción:</label>
      
                        <textarea  class="form-control ckeditor" name="descripcionCorta" id="descripcionCorta" rows="3"></textarea>
                      
                      </div>
                      <!-- /.form group -->
                      <!--
                     <div class="form-group">
                        <label>Descripción larga:</label>
      
                        <textarea class="form-control ckeditor" name="descripcionLarga" id="descripcionLarga" rows="5"></textarea>
                      
                    </div>                
                  -->
                    </div>

                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
      
             </div>
              <!-- /.col-md-6 -->
      
      
      
      
                <div class="col-md-6">
      
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Especificaciones y otros datos</h3>
                    </div>
                    <div class="card-body">
                      <!-- Date dd/mm/yyyy -->

                      <div class="form-group">
                        <label>Especificaciones:</label>
      
                        <textarea class="form-control ckeditor" name="especificaciones" id="especificaciones" rows="3"></textarea>
                      
                      </div>
                      <!-- /.form group -->
      
                      <!--
                     <div class="form-group">
                        <label>Datos de interes:</label>
      
                        <textarea class="form-control ckeditor" name="datosInteres" id="datosInteres" rows="5"></textarea>
                      
                    </div>                
                  -->
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
      
             </div>
              <!-- /.col-md-6 -->
      
      
      
            </div>
            <!-- /.row -->
      
      
      
      
               <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Imagenes</h3>
      
                 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
      
                  <div class="form-group">
                      
                     <label for="imagenes">Subir varias imagenes</label> 
                     
                     <input type="file" class="form-control-file" id="imagenes[]" name="imagenes[]"  multiple 
                     accept="image/*" >
                     
                     <div class="description">
                       Imágenes aquí  
                       <br>
                       Tamaño recomendado 800 x 800px 
                       <br>
                       Formatos permitidos: jpeg,png,jpg,gif,svg.
                       <br>
                     
                      </div>
                      {!!$errors->first('imagenes','<small>:message</small><br>')!!}
                  </div>
      
      
                </div>
      
      
                <!-- /.card-body -->
                <div class="card-footer">
                  
                </div>
              </div>
              <!-- /.card -->


              

      
      
            <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Administración</h3>
                </div>
                <!-- /.card-header -->
            <div class="card-body">
      
             <div class="row">
                    
                    <!-- /.col -->
      

                        <div class="col-sm-6"> 
                          <div class="form-group">
                            <label for="">Mínimo de stock</label>
                          <input type="text" class="form-control"  name="minStock">
                          </div>
                        </div>

                        <div class="col-sm-6"> 
                          <div class="form-group">
                            <label for="">Peso exacto del producto</label>
                          <input type="text" class="form-control" name="peso">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <!-- checkbox -->
                          <div class="form-group clearfix">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="status" name="status">
                              <label class="custom-control-label" for="status">Activo</label>
                           </div>
      
                          </div>
                          <!--
                          <div class="form-group">
                          <div class="custom-control custom-switch">
                            <input type="checkbox"  class="custom-control-input" id="sliderPrincipal" name="sliderPrincipal">
                            <label class="custom-control-label" for="sliderPrincipal">Aparece en el Slider principal</label>
                          </div>
                        </div>
                      -->
                        </div>
      
                      
      
             </div>
                  <!-- /.row -->
      
      
      
      
             <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
      
                         
                         
                       
                      </div>
                      <!-- /.form-group -->
                      
                    </div>
                    <!-- /.col -->
      
      
                 
                      
      
             </div>
                  <!-- /.row -->
      
      
      
      
                </div>
      
      
         
                <!-- /.card-body -->
                <div class="card-footer">
                <a class="btn btn-secondary float-left"  href="{{route('producto.index')}}">Volver</a>
                  <input  
                         :disabled="deshabilitarBoton==1"        
                        type="submit" value="Agregar producto" class="btn btn-primary float-right">
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