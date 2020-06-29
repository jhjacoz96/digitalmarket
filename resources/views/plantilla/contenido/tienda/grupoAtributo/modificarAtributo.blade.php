@extends('layouts.appAdmin')


@section('contenido')
<div id="grupoAtributo">
  <form action="{{route('tiendas.atributos.update',$atributo)}}" method="post">
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
              <h1>Atributos</h1>
            </div>

            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
       
                <li class="breadcrumb-item active">modificar</li>
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
                  <h3 class="card-title">Modificar atributo: {{$atributo->nombre}} </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->


                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Nombre</label>
                      <input v-model="grupo" class="form-control" name="atributo" value="{{$atributo->nombre}}" type="text">
                        {!!$errors->first('atributo','<small>:message</small><br>')!!}
                      </div>
                      
                      
            
                    </div>

                    
                  </div>
                </div>


                <div class="card-footer">

                  <a type="button" class="btn btn-secondary float-left" href="{{route('tiendas.grupoAtributo.index')}}"
                     >Volver</a>

                  <input class="btn btn-primary float-right"  value="Modificar atributo" type="submit">

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