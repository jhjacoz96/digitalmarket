@extends('layouts.appAdmin')

@section('scripts')
    
<script>

  window.data={

    editar:'si',
    
    datos:{
        "grupo":"{{$grupoAtributo->nombre}}"
    }

  }

 </script> 

@endsection

@section('contenido')
<div id="grupoAtributo">
  <form action="{{route('tiendas.grupoAtributo.update',$grupoAtributo)}}" method="post">
    @method('put')
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
              <h1>Grupos de atributos</h1>
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
                  <h3 class="card-title">Modificar grupo de atributo: {{$grupoAtributo->nombre}} </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->


                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Nombre</label>
                        <input v-model="grupo" class="form-control" id="grupo" name="grupo" value="" type="text">
                        {!!$errors->first('grupo','<small>:message</small><br>')!!}
                      </div>
                      
                      
             
                      <div class="input-group float-left mb-3 ">
                        <input type="text" name="atributos"  v-model="atributos"
                          class="form-control rounded-0">
                        <span class="input-group-append">
                          <button type="button" v-on:click="agregarGrupo()"
                            class="btn btn-info  balloon-abtn-flat">Agregar atributo</button>
                        </span>
                      </div>

                      <div class="form-group">
                        <label>Atributos que desea agregar</label>
                        <select class="select2"  id="atributo" v-model="listaatributo" name="atributo[]"
                          multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                          <option selected v-for="atributos in listaatributo">@{{atributos}}</option>
                        </select>
                        {!!$errors->first('atributo','<small>:message</small><br>')!!}                 
                        {!!$errors->first('atributo.*','<small>:message</small><br>')!!}                 

                      </div>

                    </div>

                    <div class="card-body table-responsive p-0  ">
                      <label for="">Atributos disponibles para este grupo</label>
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acción</th>
                          </tr>
                        </thead>
                        <tbody>

                          @foreach ($grupoAtributo->atributo as $atributo)
                          <tr>
                            <td class="mailbox-star">{{$atributo->id}}</td>
                            <td class="mailbox-star">{{$atributo->nombre}}</td>

                            <td class="mailbox-star">
                              <div class="btn-group">


                              <a href="" class="btn btn-default btn-sm"> <span class="fas fa-edit"
                                    aria-hidden="true"></span></a>


                                

                                <a href="{{route('grupoAtributo.atributo.delete',$atributo)}}"
                                   class="btn btn-default btn-sm d-inline float-left" 
                                    onclick="return confirm('¿Esta seguro que desea eliminar este atributo?')"><span
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

                  <a type="button" class="btn btn-secondary float-left" href="{{route('tiendas.grupoAtributo.index')}}"
                     >Volver</a>

                  <input class="btn btn-primary float-right"  value="Modificar grupo de atributos" type="submit">

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