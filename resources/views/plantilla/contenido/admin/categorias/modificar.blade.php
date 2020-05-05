@extends('layouts.appAdmin')
@section('scripts')
<script>
    window.data={
      
        editar:'si',
        datos:{
          "nombre":"{{$categoria->nombre}}"
        }
            
    
      }
</script>
@endsection
@section('contenido')
<div id="categoria">
  
  
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
                <h3 class="card-title">Actualizar categoría</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('categoria.update',$categoria)}}" method="post">
                @csrf
                @method('PUT')
            
                        <div class="card-body">
                       
                        

                            <div class="form-group">
                                <label  for="">Nombre</label>
                                <input 
                                @blur="getCategoria"
                                @focus="divAparecer=true"
                            v-model="nombre"  class="form-control" name="nombre" id="nombre" type="text">
                            </div>

                            

                            <div class="form-group">
                                <label  for="">Slug</label>
                                <input readonly
                            v-model="generarSlug" class="form-control"  name="slug" id="slug" type="text">
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
                        
                  </form>
                  
            </div>
          
            <!-- /.card -->
          </div>


          <div class="col-md-4">
            <!-- jquery validation -->
            <div class="card card-secondary">
              <div class="card-header">
              <h3 class="card-title">{{$categoria->nombre}}</h3>
              
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            
                        <div class="card-body">
                          
                          @foreach ($categoria->subCategoria as $subCategoria)
                          
                            <div class="info-box">
                              
                
                              <div class="info-box-content align-items-center">
                                <span class="info-box-text">{{$subCategoria->nombre}}</span>
                              </div>

                              <span class="">

                                <div class="btn-group">
                               
                                <a href="{{route('SubCategoria.edit',$subCategoria)}}" class="btn btn-default btn-sm">  <span class="fas fa-edit" aria-hidden ="true" ></span></a>
   
                                      
                                      
                                <form action="{{route('SubCategoria.destroy',$subCategoria)}}" method="POST">
                                          @method('DELETE')
                                          @csrf
                                          <button class="btn btn-default btn-sm d-inline float-left" onclick="return confirm('¿Esta seguro que desea eliminar esta sub categoría?')"><span class="fas fa-trash-alt" aria-hidden ="true" ></span></button>
                                        </form>
                                      
                                      
                                    
                                  </div>

                              </span>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                         
                          @endforeach

                        </div> 
                        
                        <div class="card-footer ">
                        <a href="{{route('traerCategoria.traer',$categoria)}}" class="btn btn-primary float-right">agregar sub categorias</a>
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

</div>
@endsection