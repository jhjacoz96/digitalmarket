@extends('layouts.appAdmin')

@section('contenido')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
      <h1>Marca</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('marca.index')}}">Consultar</a></li>
          <li class="breadcrumb-item active">Actualizar marca</li>
          </ol>

      </div>

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
                <h3 class="card-title">Actualizar marca</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{route('marca.update',$marca)}}" method="post" id="quickForm">
                @method('PUT')
                @csrf
                
                <div class="card-body">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Nombre</label>
                
                          <input type="text"value="{{$marca->nombre}}" required="true" name="nombre" class="form-control" >
          
  
                        {!!$errors->first('nombre','<small>:message</small><br>')!!}
    
                      </div>
  
                      <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Descripción</label>
                       
                          <input type="text" required="true" value="{{$marca->descripcion}}" name="descripcion" class="form-control" >
                      
                       
  
                        {!!$errors->first('descripcion','<small>:message</small><br>')!!}
    
                      </div>
                
                      <div class="form-group">
                        
                          <label for="imagen">Logo de la marca</label> 
                          
                            <input type="file" class="form-control-file" id="imagen" name="imagen"  
                            accept="image" >
                          
                       
                           {!!$errors->first('imagen','<small>:message</small><br>')!!}
                       </div>
               
  
               
                    <div class="form-group">
                        
                      <div class="custom-control custom-switch">
                        <input type="checkbox"
                        @if($marca->status=='A')
                            checked
                        @endif
                        "  class="custom-control-input" id ="activo" name="status">
                        <label class="custom-control-label" for="activo">Activo</label>
                      </div>
  
                    </div>
                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
               
                  <a href="{{route('marca.index')}}" class="btn btn-secondary float-left">Atrás</a>
                
                <button type="submit"  class="btn btn-primary float-right">Actualizar marca</button>
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