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
              <div class="col">
                <h5>Cantidad de zonas:</h5>
                <p>{{count($parroquia->zona)}}</p>
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

                        <div class="form-group">   
                          <label for="">Agregar zona y codigo postal</label>
                        
                          <div class="input-group float-left mb-3 ">
                            <input type="text"  v-model="zona.nombre" placeholder="Nombre" 
                              class="form-control rounded-0 ml-1">
                            <input type="text" v-model="zona.codigo"   placeholder="Código postal" 
                              class="form-control rounded-0 ml-1">
                            <span class="input-group-append">
                              <button type="button" v-on:click.prevent="agregarZona()"
                                class="btn btn-info  btn-flat ml-1">Agregar zona</button>
                            </span>
                          </div>
                        </div>
                       <input type="hidden" v-model="listaZonaFormat" name="zona">
                        <div class="form-group">
                          <label>zona que desea agregar</label>
                          <select class="select2"   
                            multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                        <option selected  v-for="(zonas,index) in listaZona">Zona: @{{zonas.nombre}} código Postal: @{{zonas.codigo}}</option>
                          </select>
                          {!!$errors->first('zona','<small>:message</small><br>')!!}                 
                          {!!$errors->first('zona.*','<small>:message</small><br>')!!}                  
  
                        </div>

                    </div>

                    <div class="card-body  ">
                      <label>Zonas pertenecientes a la parroquia {{$parroquia->nombre}}</label>
                      <div class="table-responsive p-0">
                        <table  id="table_id" class="display">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>Código postal</th>
                              <th>Acción</th>
                            </tr>
                          </thead>
                          <tbody>
  
                            @foreach ($parroquia->zona as $zona)
                            <tr>
                              <td class="mailbox-star">{{$zona->id}}</td>
                              <td class="mailbox-star">{{$zona->nombre}}</td>

                              <td class="mailbox-star">{{$zona->codigoPostal}}</td>
  
                              <td class="mailbox-star">
                                <div class="btn-group">
  
                                  
                                  <a href="{{route('filtroDireccion.zona.edit',$zona)}}" class="btn btn-default btn-sm"> <span class="fas fa-edit"
                                    aria-hidden="true"></span></a>
  
  
                                  
  
                                  <a href="{{route('filtroDireccion.zona.eliminar',$zona)}}"
                                     class="btn btn-default btn-sm d-inline float-left" 
                                      onclick="return confirm('¿Esta seguro que desea eliminar este zona?')"><span
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