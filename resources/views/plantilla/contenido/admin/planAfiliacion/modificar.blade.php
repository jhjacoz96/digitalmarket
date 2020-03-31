@extends('layouts.appAdmin')
@section('contenido')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Plan de afiliación</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('Plan.index')}}">Consultar</a></li>
            <li class="breadcrumb-item active">Actualizar</li>
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
            <!-- jquery validation -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Actualizar plan de afiliación</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('Plan.update',$plan)}}" method="post" id="quickForm">
                @method('PUT')
                @csrf
                <div class="card-body">

                  
                  

                  <div class="form-group">
                    <label for="exampleInputEmail1">Descripción</label>
                    
                    <textarea required="true" name="descripcion" value="{{$plan->descripcion}}" id="descripcion" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    {!!$errors->first('descripcion','<small>:message</small><br>')!!}
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Procentaje</label>
                    <input type="text" value="{{$plan->precio}}" required="true" name="porcentaje" class="form-control" id="porcentaje"  placeholder="Ingrese  porcentaje un porcentaje  ">
                    {!!$errors->first('porcentaje','<small>:message</small><br>')!!}
                  </div>

                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit"  class="btn btn-primary float-right">Actualizar Plan de afiliación</button>
                </div>

              </form>
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
@endsection