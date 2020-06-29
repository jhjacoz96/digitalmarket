@extends('layouts.appAdmin')
@section('contenido')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Perfil</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('administrador.show',Auth::user()->id)}}">Perfil</a></li>
          <li class="breadcrumb-item active">Actualizar cuenta bancaria</li>
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
                <h3 class="card-title">Actualizar perfil</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" enctype="multipart/form-data" action="{{route('administrador.update',$tienda)}}" method="post" id="quickForm">
                @method("PUT")
                @csrf
                
                <div class="p-2">
                  @include('flash::message')
               </div>
               
               <div class="card-body "> 
                 <div class="row">
                   <div class="col-md-6">
                    
                    <p class="lead">Información la cuenta bancaria</p>
                       <hr>

                     <div class="form-group">
                         
                       <label for="imagen">Subir logo de la tienda</label> 
                       
                       <input type="file" class="form-control-file" id="imagen" name="imagen"  
                       accept="image" >
                       
                     
                         {!!$errors->first('imagen','<small>:message</small><br>')!!}
                     </div>
   
                   
                       <div class="form-group">
                         <label for="exampleInputEmail1">Nombre de la tienda</label>
                         <input type="text"  name="nombreTienda" value="{{$tienda->nombreTienda}}" class="form-control" id="nombreTienda"  >
                       </div>
   
                       <div class="form-group">
                         <label for="exampleInputEmail1">Nombre del encargado</label>
                         <input type="text"  name="nombre" value="{{$tienda->nombre}}" class="form-control" id="nombre" placeholder="Ingrese su nombre" >
                       </div>
                     
                       <div class="form-group">
                         <label for="exampleInputEmail1">Apellido del encargado</label>
                         <input type="text"  value="{{$tienda->apellido}}"
                         name="apellido" class="form-control" id="apellido" placeholder="Ingrese su apellido" >
                       </div>
                       
                       <div class="form-group">
                         <label for="exampleInputEmail1">Telefono</label>
                         <input type="text"  value="{{$tienda->telefono}}"
                         name="telefono" class="form-control" id="telefono" >
                       </div>
   
                         
                       <div class="form-group">
                         <label for="exampleInputEmail1">Correo electrónico</label>
                         <input type="text"  name="correo" class="form-control" value="{{$tienda->correo}}"id="correo" placeholder="Ingrese un correo electrónico" >
                         {!!$errors->first('correo','<small>:message</small><br>')!!}
                       </div>
   
                       <div class="form-group">
                         <label for="exampleInputEmail1">Plan afiliación</label>
                         <select name="planAfiliacion" class="form-control" name="planAfiliacion" id="">
                           @foreach ($planAfiliacion as $item)     
                         <option
                         @if($item->id==$tienda->planAfiliacion->id)
                         selected
                         @endif
                         value="{{$item->id}}">{{$item->nombre}}</option>
                           @endforeach
                         </select>
                         {!!$errors->first('planAfiliacion','<small>:message</small><br>')!!}
                       </div>
                       
   
   
                     
                   </div>
 
                  
                 </div>
              </div>


                <!-- /.card-body -->
                <div class="card-footer">
               

                <button type="submit" href=""  class="btn btn-primary float-right">Actualizar perfil</button>
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