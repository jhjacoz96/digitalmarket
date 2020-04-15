@extends('layouts.appAdmin')

@section('scripts')
    
<script>

  window.data={

    editar:'si',
    datos:{
      "nombre":"{{$parroquia->nombre}}"  
        }

  }

 </script> 

@endsection

@section('contenido')
<div id="filtroDireccion">
  <form action="{{route('filtroDireccion.parroquia.update',$parroquia)}}" method="post">
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
              <h1>Filtros de direcciones</h1>
            </div>

            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a >Consultar</a></li>
                
              </ol>

            </div>
          </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <section class="content ">

          <div class="callout callout-info">

            <div class="row">
              <div class="col">
                <h5>Estado:</h5>
                <p>{{$parroquia->municipio->estado->nombre}}</p>
              </div>
              <div class="col">
                <h5>Municipio:</h5>
                <p>{{$parroquia->municipio->nombre}}</p>
              </div>
              <div class="col">
                <h5>Parroquia:</h5>
                <p>{{$parroquia->nombre}}</p>
              </div>
            </div>
          </div>
        </section>
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->



            <div class="col-md-12
            ">
              <!-- jquery validation -->
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Modificar parroquia: {{$parroquia->nombre}} </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Nombre</label>
                        <input v-model="estado" class="form-control"  id="parroquia" name="parroquia" type="text">
                        {!!$errors->first('parroquia','<small>:message</small><br>')!!}
                      </div>
                      
                        <input  v-model="formatEstado" class="form-control" id="" name="" type="hidden">
                      
                    </div>

                    
                  </div>
                </div>


                <div class="card-footer">

                  <a class="btn btn-secondary float-left" href="{{route('filtroDireccion.municipio.edit',$parroquia->municipio)}}">Atrás</a>

                
                

                <input class="btn btn-primary float-right"  value="Modificar parroquia" type="submit">

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
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </form>
</div>
@endsection