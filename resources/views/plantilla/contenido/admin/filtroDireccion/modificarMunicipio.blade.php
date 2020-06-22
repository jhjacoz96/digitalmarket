@extends('layouts.appAdmin')

@section('scripts')
    
<script>

  window.data={

    editar:'si',
    datos:{
      "nombre":"{{$municipio->nombre}}"  
        }

  }

 </script> 

@endsection

@section('contenido')
<div id="filtroDireccion">
  <form action="{{route('filtroDireccion.municipio.update',$municipio)}}" method="post">
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
                <p>{{$municipio->estado->nombre}}</p>
              </div>
              <div class="col">
                <h5>Municipio:</h5>
                <p>{{$municipio->nombre}}</p>
              </div>
              <div class="col">
                <h5>Cantidad de parroquias:</h5>
                <p>{{count($municipio->parroquia)}}</p>
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
                  <h3 class="card-title">Modificar municipio </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                

                <div class="card-body">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Nombre</label>
                        <input v-model="estado" class="form-control"  id="municipio" name="municipio" type="text">
                        {!!$errors->first('municipio','<small>:message</small><br>')!!}
                      </div>
                      
                        <input  v-model="formatEstado" class="form-control" id="" name="" type="hidden">
                      
                      
                      <div class="input-group float-left mb-3 ">
                        <input type="text" v-model="municipio" name="parroquia" id="parroquia"
                          class="form-control rounded-0">
                        <span class="input-group-append">
                          <button type="button" v-on:click.prevent="agregarMunicipio()"
                            class="btn btn-info  btn-flat">Agregar parroquia</button>
                        </span>
                      </div>

                      <div class="form-group">
                        <label>Parroquia que desea agregar</label>
                        <select class="select2" v-model="listaMunicipio" id="parroquia" name="parroquia[]"
                          multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                          <option selected v-for="municipios in listaMunicipio">@{{municipios}}</option>
                        </select>
                        {!!$errors->first('parroquia','<small>:message</small><br>')!!}                 
                        {!!$errors->first('parroquia.*','<small>:message</small><br>')!!}                   

                      </div>

                    </div>

                    <div class="card-body  ">
                    <label>Parroquias pertenecientes al municipio {{$municipio->nombre}}</label>
                    <div class="table-responsive p-0">
                      <table id="table_id" class="display">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acción</th>
                          </tr>
                        </thead>
                        <tbody>

                          @foreach ($municipio->parroquia as $parroquia)
                          <tr>
                            <td class="mailbox-star">{{$parroquia->id}}</td>
                            <td class="mailbox-star">{{$parroquia->nombre}}</td>

                            <td class="mailbox-star">
                              <div class="btn-group">


                                <a href="{{route('filtroDireccion.parroquia.edit',$parroquia)}}" class="btn btn-default btn-sm"> <span class="fas fa-edit"
                                  aria-hidden="true"></span></a>


                                

                                <a href="{{route('filtroDireccion.parroquia.eliminar',$parroquia)}}"
                                   class="btn btn-default btn-sm d-inline float-left" 
                                    onclick="return confirm('¿Esta seguro que desea eliminar este parroquia?')"><span
                                      class="fas fa-trash-alt" aria-hidden="true"></span>
                                </a>
                                

                              </div>
                            </td>
                          </tr>

                          @endforeach

                        </tbody>
                      </table>
                    </div>

                    </div>
                  </div>
                </div>


                <div class="card-footer">

                  <a class="btn btn-secondary float-left" href="{{route('filtroDireccion.edit',$municipio->estado)}}">Atrás</a>

                  <input class="btn btn-primary float-right"  value="Modificar Municipio" type="submit">

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