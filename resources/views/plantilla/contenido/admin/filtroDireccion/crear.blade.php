@extends('layouts.appAdmin')

@section('scripts')
    
<script>

  window.data={

    editar:'no'
    

  }

 </script> 

@endsection

@section('contenido')
<div id="filtroDireccion">
  <form action="{{route('filtroDireccion.store')}}" method="post">
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



            <div class="col-md-12
            ">
              <!-- jquery validation -->
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Agregar estado</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->


                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Nombre</label>
                        <input v-model="estado" class="form-control" id="estado" name="estado" type="text">
                        {!!$errors->first('estado','<small>:message</small><br>')!!}
                      </div>
                      
                        <input  v-model="formatEstado" class="form-control" id="" name="" type="hidden">
                      

                      <div class="input-group float-left mb-3 ">
                        <input type="text" v-model="municipio" name="municipios" id="municipios"
                          class="form-control rounded-0">
                        <span class="input-group-append">
                          <button type="button" v-on:click.prevent="agregarMunicipio()"
                            class="btn btn-info  btn-flat">Agregar municipio</button>
                        </span>
                      </div>

                      <div class="form-group">
                        <label>Municipios que desea agregar</label>
                        <select class="select2" v-model="listaMunicipio" id="municipio" name="municipio[]"
                          multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                          <option selected v-for="municipios in listaMunicipio">@{{municipios}}</option>
                        </select>
                        {!!$errors->first('municipio','<small>:message</small><br>')!!}                 
                        {!!$errors->first('municipio.*','<small>:message</small><br>')!!}                 

                      </div>

                    </div>

                    <div class="card-body table-responsive p-0  ">
                      <label for="">Estados disponibles</label>
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acción</th>
                          </tr>
                        </thead>
                        <tbody>

                          @foreach ($estado as $estados)
                          <tr>
                            <td class="mailbox-star">{{$estados->id}}</td>
                            <td class="mailbox-star">{{$estados->nombre}}</td>

                            <td class="mailbox-star">
                              <div class="btn-group">


                              <a href="{{route('filtroDireccion.edit',$estados)}}" class="btn btn-default btn-sm"> <span class="fas fa-edit"
                                    aria-hidden="true"></span></a>


                                

                                <a href="{{route('filtroDireccion.estado.eliminar',$estados)}}"
                                   class="btn btn-default btn-sm d-inline float-left" 
                                    onclick="return confirm('¿Esta seguro que desea eliminar este estado?')"><span
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


                <div class="card-footer">

                  <input class="btn btn-primary float-right"  value="Agregar Estado" type="submit">

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