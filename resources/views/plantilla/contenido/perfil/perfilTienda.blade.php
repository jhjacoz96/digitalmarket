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
          
          <li class="breadcrumb-item active">Perfil</li>
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
                <h3 class="card-title">Mi perfil</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="" method="post" id="quickForm">
                
                @csrf
                
                <div class="p-2">
                  @include('flash::message')
               </div>


               <div class="box-profile">
                <div class="text-center">
                  <img style="border-radius: 50%;" class="profile-user-img img-fluid img-circle"
                        @if(!empty($tienda->imagen->url))
                        src="{{$tienda->imagen->url}}"
                        @else
                        src="{{asset('/imagenes/tienda/tienda.png')}}"
                        @endif

                       alt="User profile picture">
                </div>
          
  
                <h3 class="profile-username text-center">{{$tienda->nombreTienda}}</h3>
                  
                <p class="text-muted text-center">Plan de afiliacion {{$tienda->planAfiliacion->nombre}}</p>
               </div>

                <div class="card-body row">

                  <div class=" col-md-6">
        
                      
                      <p class="lead">Información de la tienda</p>
                        <hr>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Nombre del encargado</label>
                          <input type="text" required="true" name="nombre" value="{{$tienda->nombre}}" class="form-control" id="nombre" placeholder="Ingrese su nombre" disabled>
                        </div>
                    
                        <div class="form-group">
                          <label for="exampleInputEmail1">Apellido del encargado</label>
                          <input type="text" required="true" value="{{$tienda->apellido}}"
                          name="apellido" class="form-control" id="apellido" placeholder="Ingrese su apellido" disabled>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Telefono</label>
                          <input type="text" required="true" value="{{$tienda->telefono}}"
                          name="telefono" class="form-control" id="telefono" placeholder="Ingrese su apellido" disabled>
                        </div>
                      
                        
                        <p class="lead">Información para la sesión</p>
                        <hr>
                          
                        <div class="form-group">
                          <label for="exampleInputEmail1">Correo electrónico</label>
                          <input type="text" required="true" name="correo" class="form-control" value="{{$tienda->correo}}"id="correo" placeholder="Ingrese un correo electrónico" disabled>
                        </div>
    
                  </div>

                  <div class=" col-md-6">

                    <p class="lead">Información la cuenta bancaria</p>
                      <hr>

                    

                    <div class="form-group ">
                      <label for="exampleInputEmail1">Nombre del banco</label>
                    <input disabled type="text"value="{{$tienda->tiendaCuentaBancaria->medioPago}}" required="true" name="nombreBanco" class="form-control"  id="nombreBanco" >
                      {!!$errors->first('nombreBanco','<small>:message</small><br>')!!}

                    </div>

                    <div class="form-group ">
                      <label for="exampleInputEmail1">Detalle de la cuenta</label>
                    <input disabled type="text" value="{{$tienda->tiendaCuentaBancaria->cuenta}}"  name="detalleCuenta" class="form-control" id="detalleCuenta" >
                      {!!$errors->first('detalleCuenta','<small>:message</small><br>')!!}
                    </div>

                  

                    <div class="form-group ">
                      <label for="exampleInputEmail1">Documento de identidad</label>
                      <div class="d-flex">
                          <select disabled name="tipo" class="form-control col-3" id="" >
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
                        <input type="text" disabled name="documentoIdentidad" class="form-control ml-1" value="{{$tienda->tiendaCuentaBancaria->documentoIndentidad}}" id="documentoIdentidad">
                      </div>

                    </div>


                    <div class="form-group ">
                      <label for="">Titular de la cuenta</label>
                      <input disabled  value="{{$tienda->tiendaCuentaBancaria->titular}}"  class="form-control" type="text" name="titularCuenta" >
                    </div>

                    <div class="form-group">
                      <label for="">Tipo cuenta</label>
                    <input disabled value="{{$tienda->tiendaCuentaBancaria->tipoCuenta}}"  class="form-control" type="text" name="tipoCuenta" >
                    </div>

                    <div class="form-group ">
                      <label for="">Correo</label>
                      <input disabled  class="form-control" value="{{$tienda->tiendaCuentaBancaria->correo}}" type="text" name="correo" >
                    </div>

                    <div class="form-group ">
                      <label for="">Telefono</label>
                      <input disabled  class="form-control" value="{{$tienda->tiendaCuentaBancaria->telefono}}" type="text" name="telefono" >
                    </div>



                  </div>

                </div>

                <!-- /.card-body -->
                <div class="card-footer">
               
                    <a type="submit" href="{{route('Empleado.password',$user->id)}}" class="btn btn-secondary float-left">Actualizar contraseña</a>

                    <a type="submit" href="{{route('administrador.edit',$user->id)}}"  class="btn btn-primary float-right">Actualizar perfil</a>
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