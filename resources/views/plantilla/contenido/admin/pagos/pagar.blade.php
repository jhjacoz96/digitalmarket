@extends('layouts.appAdmin')

@section('contenido')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Pagos a tienda</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{url('/pagos-tiendas')}}">Consultar</a></li>
            <li class="breadcrumb-item active">Pagar</li>
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
              <h3 class="card-title">Pagar pedido {{$pagoTiendaPedido->pedido->id}} a la tienda {{$tienda->nombreTienda}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
           
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead">Información de la cuenta bancaria</p>
                             <hr>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Banco</label>
                            <input disabled type="text" value="{{$tienda->tiendaCuentaBancaria->medioPago}}"required="true"  class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Banco</label>
                            <input disabled type="text" value="{{$tienda->tiendaCuentaBancaria->cuenta}}"required="true"  class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Titular de la cuenta</label>
                            <input disabled type="text" value="{{$tienda->tiendaCuentaBancaria->titular}}"required="true"  class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo de cuenta cuenta</label>
                            <input disabled type="text" value="{{$tienda->tiendaCuentaBancaria->tipoCuenta}}"required="true"  class="form-control">    
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Documento de indentidad</label>
                            <input disabled type="text" value="{{$tienda->tiendaCuentaBancaria->tipodocumento}}{{$tienda->tiendaCuentaBancaria->documentoIndentidad}}"required="true"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telefono</label>
                            <input disabled type="text" value="{{$tienda->tiendaCuentaBancaria->telefono}}{"required="true"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Correo</label>
                            <input disabled type="text" value="{{$tienda->tiendaCuentaBancaria->correo}}"required="true"  class="form-control">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <p class="lead">Información del pago</p>
                             <hr>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Monto a pagar</label>
                                <input disabled type="text" value="Bs {{$pagoTiendaPedido->montoPagado}}"required="true"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Código de la tienda</label>
                                <input disabled type="text" value="{{$pagoTiendaPedido->tienda->codigo}}"required="true"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre de la</label>
                                <input disabled type="text" value="{{$pagoTiendaPedido->tienda->nombreTienda}}"required="true"  class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

         
             
                <div class="card-footer">
              
                <a href="" class="btn btn-secondary float-left">Atrás</a>
                <a href="{{url('/pagar/'.$pagoTiendaPedido->id)}}" class="float-right btn btn-primary" onclick="return confirm('Realice esta acción solo si ya le ha realizar el pago a la tienda')" href="">Pagar pedido</a>
            </div>

       
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