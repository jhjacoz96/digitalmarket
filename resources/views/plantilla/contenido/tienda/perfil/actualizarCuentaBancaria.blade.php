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
          <li class="breadcrumb-item active">Actualizar perfil</li>
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
            <form role="form" enctype="multipart/form-data" action="{{url('/tiendas/actualizar-cuenta/'.$tienda->tiendaCuentaBancaria->id)}}" method="post" id="quickForm">     
                @method("PUT")  
                @csrf
                
                <div class="p-2">
                  @include('flash::message')
               </div>
               
               <div class="card-body "> 
                 <div class="row">
 
                   <div class=" col-md-6">
 
                     <p class="lead">Información la cuenta bancaria</p>
                       <hr>
 
                  
                     <div class="form-group ">
                       <label for="exampleInputEmail1">Nombre del banco</label>
                       <input  type="text" required="true" value="{{$tienda->tiendaCuentaBancaria->medioPago}}" name="nombreBanco" class="form-control" id="nombreBanco" >
                       {!!$errors->first('nombreBanco','<small>:message</small><br>')!!}
 
                     </div>
 
                     <div class="form-group ">
                       <label for="exampleInputEmail1">Detalle de la cuenta</label>
                       <input type="text" value="{{$tienda->tiendaCuentaBancaria->cuenta}}" name="detalleCuenta" class="form-control" id="detalleCuenta" >
                       {!!$errors->first('detalleCuenta','<small>:message</small><br>')!!}
                     </div>
 
                   
 
                     <div class="form-group ">
                       <label for="exampleInputEmail1">Documento de identidad</label>
                       <div class="d-flex">
                           <select  name="tipo" class="form-control col-3" id="" >
                            <option value="" >Seleccione una opción</option>
                            <option
                            @if($tienda->tiendaCuentaBancaria->tipodocumento=='V-')
                            selected
                            @endif
                            value="V-">V-Venezolano</option>
                            <option
                            @if($tienda->tiendaCuentaBancaria->tipodocumento=='P-')
                            selected
                            @endif
                            value="P-">P-Pasaporte</option>
                            <option
                            @if($tienda->tiendaCuentaBancaria->tipodocumento=='E-')
                            selected
                            @endif
                            value="E-">E-Extranjero</option>
                            <option 
                            @if($tienda->tiendaCuentaBancaria->tipodocumento=='J-')
                            selected
                            @endif
                            value="J-">J-Jurídico</option>
                            <option
                            @if($tienda->tiendaCuentaBancaria->tipodocumento=='R-')
                            selected
                            @endif
                            value="R-">R-Firmas Personales</option>
                            <option
                            @if($tienda->tiendaCuentaBancaria->tipodocumento=='O-')
                            selected
                            @endif
                            value="O-">O-Organización Comunal</option>
                           </select>
                       <input type="text"  name="documentoIdentidad" class="form-control ml-1" id="documentoIdentidad"  >
                       </div>
 
                     </div>
 
 
                     <div class="form-group ">
                       <label for="">Titular de la cuenta</label>
                       <input  value="{{$tienda->tiendaCuentaBancaria->titular}}"  class="form-control" type="text" name="titularCuenta" >
                     </div>
                     
                     <div class="form-group">
                       <label for="">Tipo cuenta</label>
                       <input  value="{{$tienda->tiendaCuentaBancaria->tipoCuenta}}" class="form-control" type="text" name="tipoCuenta" >
                     </div>
 
                     <div class="form-group ">
                       <label for="">Correo</label>
                       <input  value="{{$tienda->tiendaCuentaBancaria->correo}}" class="form-control" type="text" name="correoCuenta" >
                     </div>
 
                     <div class="form-group ">
                       <label for="">Telefono</label>
                       <input value="{{$tienda->tiendaCuentaBancaria->telefono}}" class="form-control" type="text" name="telefonoCuenta" >
                     </div>
 
 
                   </div>
                 </div>
              </div>


                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{url('/tiendas/ver-cuenta')}}" class="btn btn-secondary" >Atrás</a>

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