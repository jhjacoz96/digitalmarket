@extends('layouts.appAdmin')

@section('estilos')
    
<!--<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">-->
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.css')}}">

@endsection

@section('scripts')
    
<!--<script src="https://unpkg.com/vue-multiselect@2.1.0"></script>-->

<script src="/adminlte/ckeditor/ckeditor.js"></script>

<!-- select2---->
<script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>

<script src="{{asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>

<script>

    window.data={
  
      editar:'si',
      datos:{
  
        "rol":"{{$rol}}",
        "tienda_id":"{{$producto->tienda_id}}",
        "nombre":"{{$producto->nombre}}",
        "precioAnterior":"{{$producto->precioAnterior}}",
        "precioActual":"{{$producto->precioActual}}",
        "porcentajeDescuento":"{{$producto->porcentajeDescuento}}",
        "selectedCategoria":"{{$producto->subCategoria->categoria->id}}",
        "selectedSubCategoria":"{{$producto->subCategoria->id}}",
        "tipoCliente":"{{$producto->tipoCliente}}",
        "slug":"{{$producto->slug}}",
        "id":"{{$producto->id}}"
      }
          
  
    }

  
  $(function () {
      //Initialize Select2 Elements
      $('#categoriaa_id').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    

 //Uso de lightbox
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

})

  
  </script>

@endsection

@section('contenido')

<div id="producto">
<form action="{{route('producto.update',$producto)}}" method="post" enctype="multipart/form-data">
  @method('PUT')
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
            <li class="breadcrumb-item active">Modificar producto</li>
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

            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
  
  
                  <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-shopping-basket"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">Ventas</span>
                      <span class="info-box-number">{{$producto->ventas}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
  
                 
                </div>
                <!-- /.form-group -->
    
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
  
  
                  <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-eye"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">Visitas</span>
                      <span class="info-box-number">{{$producto->visitas}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
  
                 
                </div>
                <!-- /.form-group -->
    
              </div>
            </div>
      
      
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Datos del producto</h3>
      
                
                </div>
                <!-- /.card-ºheader -->
                <div class="card-body">

                  <div class="row">

                  

                    <div class="col-md-6">


                      <div class="form-group">
                        <label for="">Tipo de producto</label>
                        <div class="custom-control custom-radio">
                          <input disabled class="custom-control-input"  @click="tipoProd()" v-bind:value="tipoProducto" type="radio" id="customRadio1" name="tipoProd">
                          <label for="customRadio1" class="custom-control-label">Producto común</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input disabled class="custom-control-input" type="radio" id="customRadio2" v-bind:value="tipoProducto" name="tipoProd" @click="tipoProd()">
                          <label for="customRadio2" class="custom-control-label">Producto con variación de atributos</label>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
      
                        <label>Tienda a la que pertenece este producto</label>
                        <div class="form-group col-md-6">

                        <a href="{{route('tienda.show',$producto->tienda->id)}}" class="btn btn-info btn-sm"><span class="fas fa-eye mr-1"></span>{{$producto->tienda->nombreTienda}} ({{$producto->tienda->codigo}})</a>
                            </div>
      
                          <input type="hidden" name="tienda" value="{{$producto->tienda->codigo}}">
                      </div>
                      <!-- /.form-group -->
                      
                    </div>


                      <div class="col-md-6">
                        <div class="form-group">
                          
                          <label>Nombre</label>
                          <input v-model="nombre" class="form-control" type="text" id="nombre" name="nombre"
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
                            @{{selectedCategoria}}
                            <select v-model="selectedCategoria"  data-old="{{old('categoria_id')}}" @change="cargarSubCategorias" id="categoria_id" name="categoria_id"  class="form-control" style="width: 100%;">
    
                              <option value="" selected="selected">Seleccione un a categoria</option>
                                
                              <option :value="categoria.id" v-for="(categoria,index) in categorias">@{{categoria.nombre}}</option>
                            
                            </select>
                             
                             
                              
                          </div>
                              <div class="col-md-6">
                               
                               
                            <label>Sub categoria</label>
                            
                              <select v-model="selectedSubCategoria" name="subCategoria_id" id="subCategoria_id" data-old="{{old('subCategoria_id')}}" class="form-control select2" style="width: 100%;">
                                
                                <option value="" selected="selected" >Seleccione una categoria</option>
                                
                                <option v-for="(subCategoria,index)    in obtenerSubCategorias" 
                                
                              :value="subCategoria.id" >@{{subCategoria.nombre}}</option>
                              </select>
                              
                            </div>
                          
                          </div>
                          
                          <div class="form-group" v-if="tipoProducto!='combinacion'" >

                            <label>Cantidad</label>
                            <input class="form-control" type="number" id="cantidad" name="cantidad" :disabled="disableCantidad==true" value="{{$producto->cantidad}}" >
                          </div>
                      
                        </div>
                        <!-- /.form-group -->
            
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
      
      
                
                <!-- /.card-body -->
                <div class="card-footer">
                 
              </div>
            </div>
      
              <!-- /.card -->

              <!--
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

                    <div class="col-md-4">
                     
                          <div class="form-group" v-for="(item,index) in grupos">
                            
                            <label for="">@{{item.nombre}}</label>
                            
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
           
              </div>-->
            


                  <div class="card card-secondary" v-if="tipoProducto=='combinacion'">
                                
                    <div class="card-header">
                        <h3 class="card-title">Mis combinaciones</h3>
                    </div>
                    <div class="card-body">

                  

                      <div class="row">

      
                        
                        <div class="col-md-6 col-sm-6" v-if="editarActivo">
                         
                            <div class="form-group">
                              <input class="form-control" type="text" v-model='combinacion.cantidad'>
                            </div>
                            <button class="btn btn-secondary" @click.prevent="editarActivo=false"  >
                              Cancelar
                            </button>
                            <button type="button" @click.prevent="actualizarCombinacion(combinacion)" class="btn btn-primary float-right">Modificar combinación</button>
                          
                        </div>
                        
                        <div class="col-md-6">
                      
                          <div class="card-body table-responsive p-0" >
                           <table class="table table-hover"  >
                               <thead>
                                   <tr>
                                       <th scope="col">#</th>
                                       <th scope="col">Variante</th>
                                       <th scope="col">Cantidad</th>
                                     
   
   
                                   </tr>
                               </thead>
                               <tbody>
                                   <tr v-for="( items, index) in listaCombinacion2"  :key="index"  >
   
                                       <td scope="row">@{{index+1}}</td>
   
                                       <td>
                                           <div v-for="(item, index) in items.atributo" :key="index">
                                              @{{item.nombre}}
                                           </div>
                                       </td>
   
                                       <td>
                                           <input v-model="items.cantidad" class="col-md-4" type="text">
                                       </td>
   
                                       
   
                                       <td>
                                           <a href="" @click.prevent="eliminarCombinacionDB(items,index)">
                                               <i class="fas fa-trash-alt" style="color:red;"></i>
                                           </a>
                                       </td>
                                       
                                       <td>
                                           <a href="" @click.prevent="editarCombinacion(items,index)">
                                               <i class="fas fa-edit" 
                                               ></i>
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
           
                    </div>
           
                  </div>


            
      
                  <!--
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Sección de Precios</h3>
      
                  
                </div>
                
                <div class="card-body">
                  <div class="row">
  
      
                    <div class="col-md-3">
                      <div class="form-group">
      
                        <label>Precio anterior</label>
                        
      
      
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">$</span>
                        </div>
                        <input 
                        v-model="precioAnterior"
                        class="form-control" type="number" id="precioAnterior" name="precioAnterior" min="0" value="0" step=".01">                 
                      </div>
                       
                      </div>
                    
                      
                    </div>
                    
      
      
      
                    <div class="col-md-3">
                      <div class="form-group">
      
                        <label>Precio actual</label>
                         <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">$</span>
                        </div>
                        <input 
                        v-model="precioActual"
                        class="form-control" type="number" id="precioActual" name="precioActual" min="0" value="0" step=".01">                 
                      </div>
      
                      <br>
                      <span id="descuento">
                          @{{generarDescuento}}
                      </span>
                      </div>
                    
          
                    </div>
                    
      
      
      
      
                    <div class="col-md-6">
                      <div class="form-group">
      
                        <label>Porcentaje de descuento</label>
                         <div class="input-group">                  
                        <input 
                        v-model="porcentajeDescuento"
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
                    
                      
                    </div>
                   
      
      
                  </div>
                  
      
      
                </div>
                
                <div class="card-footer">
                  
                </div>
              </div>
              -->
              
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
      
                        <textarea  class="form-control ckeditor" name="descripcionCorta" id="descripcionCorta" rows="3">
                            {!!$producto->descripcionCorta!!}
                        </textarea>
                      
                      </div>
                      <!-- /.form group -->
                      <!--
                     <div class="form-group">
                        <label>Descripción larga:</label>
      
                        <textarea class="form-control ckeditor" name="descripcionLarga" id="descripcionLarga" rows="5">
                            {!!$producto->descripcionLarga!!}
                        </textarea>
                      
                    </div>    -->            
      
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
      
                        <textarea class="form-control ckeditor" name="especificaciones" id="especificaciones" rows="3">
                            {!!$producto->especificaciones!!}
                        </textarea>
                      
                      </div>
                      <!-- /.form group -->
      
                      <!--
                     <div class="form-group">
                        <label>Datos de interes:</label>
      
                        <textarea class="form-control ckeditor" name="datosInteres" id="datosInteres" rows="5">
                            {!!$producto->datosInteres!!}
                        </textarea>
                      
                    </div>       -->         
      
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
                       Un número ilimitado de archivos pueden ser argado en este campo.
                       <br>
                       Limite de 2048MB por imagen.
                       <br>
                       Tipos permitidos: jpeg,png,jpg,gif,svg.
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
                  <div class="card-title">
                    Galería de imagenes
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">

                    @foreach ($producto->imagen as $imagen)

                  <div class="col-sm-2" id="idimagen-{{$imagen->id}}">
                      <a href=" {{$imagen->url}}" data-toggle="lightbox" data-title="id:{{$imagen->id}}" data-gallery="gallery">
                          <img  src="{{$imagen->url}}" class="img-fluid mb-2"/>
                        </a>
                        <br>
                        <a href="{{$imagen->url}}"
                          v-on:click.prevent="eliminarImagen({{$imagen}})"
                          >
                          <i class="fas fa-trash-alt" style="color:red;  "></i>{{$imagen->id}}
                        </a>
                      </div>
                      
                    @endforeach

                  </div>
                </div>
              </div>





            <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Administración</h3>
                </div>
                <!-- /.card-header -->
            <div class="card-body">
      
             <div class="row">
                    
                    <!-- /.col -->
                    <div class="col-sm-6">
                          <!-- checkbox -->
                          <div class="form-group clearfix">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="status" name="status"
                              
                              @if($producto->status='si')
                                checked
                              @endif

                              >
                              <label class="custom-control-label" for="status">Activo</label>
                           </div>
      
                          </div>
      
                        <!--<div class="form-group">
                          <div class="custom-control custom-switch">
                            <input type="checkbox"  class="custom-control-input" id="sliderPrincipal" name="sliderPrincipal">
                            <label class="custom-control-label" for="sliderPrincipal">Aparece en el Slider principal</label>
                          </div>
                        </div>-->
      
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
                <a class="btn btn-secondary float-left" href="{{route('producto.index')}}">volver</a>
                         <input  
                         :disabled="deshabilitarBoton==1"        
                        type="submit" value="Actualizar productos " class="btn btn-primary float-right">
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