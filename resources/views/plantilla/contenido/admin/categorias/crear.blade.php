  @extends('layouts.appAdmin')
  @section('contenido')
  <div id="categoria">
    <form action="{{route('categoria.store')}}" method="post">
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



            <div class="col-md-8">
              <!-- jquery validation -->
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Agregar categoría</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                
              
                          <div class="card-body">

                            <div class="form-group">
                              <label for="">Tipo de línea</label>
                              <select name="tipoLinea" id="tipoLinea" 
                              class="form-control"
                              required
                              >
                                <option value="">Seleccione una línea</option>
                                <option value="Blanca">Blanca</option>
                                <option value="Marrón">Marrón</option>
                              </select>
                            </div>

                              <div class="form-group">
                                  <label  for="">Nombre</label>
                                  <input 
                                  @blur="getCategoria"
                                  @focus="divAparecer=true"
                                  v-model="nombre" class="form-control" name="nombre" id="nombre" type="text">
                              </div>

                              

                              <div class="form-group">
                                  <label  for="">Slug</label>
                                  <input readonly
                                  v-model="generarSlug" class="form-control" name="slug" id="slug" type="text">
                                  <div v-if="divAparecer " v-bind:class="divClaseSlug">
                                      @{{divMensajeSlug}}
                                  </div>
                                  <br v-if="divAparecer">
                              </div>


                              <div class="form-group">  
                                  <label  for="">Descripcion</label>
                                  <input class="form-control" name="descripcion" cols="30" rows="10" id="descripcion" type="text">
                                
                          </div>
                              
                          </div>
                          <div class="card-footer">

                            <input 
                            :disabled="deshabilitarBoton==1"
                            class="btn btn-primary float-right" type="submit" value="Agregar categoria">
                          </div>
                      
            
                </div>
              <!-- /.card -->
              </div>



              <div class="col-md-4">
                <!-- jquery validation -->
                <div class="card card-secondary ">
                  <div class="card-header">
                  <h3 class="card-title">Categorias disponibles</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                
                            <div class="card-body">
                              @php
                              use App\Categoria;
                                  $categorias=Categoria::all();
                                  
                              @endphp
        
    
                              @foreach ($categorias as $item)
                              
                              <div class="card card-warning collapsed-card">
                                  <div class="card-header">
                                    <h3 class="card-title">{{$item->nombre}}</h3>
                    
                                    <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                      </button>
                                    </div>
                                    <!-- /.card-tools -->
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body">
                                    
    
                                    @foreach ( $item->subCategoria as $sub)
                                        <span class="badge badge-secondary">
                                          {{$sub->nombre}}
                                        </span>
                                    @endforeach
                                    
    
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                  
                              @endforeach
    
                           
    
                          
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