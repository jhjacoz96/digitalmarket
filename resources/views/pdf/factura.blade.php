<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->
 
 <!-- Font Awesome -->
 <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
 <!-- Ionicons -->
 <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 


 <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
 <!-- Google Font: Source Sans Pro -->
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">


          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <img src="{{asset('/imagenes/logo/logo.png')}}"
                 alt="AdminLTE Logo"
                 width="60"
                class="brand-image "
                 style="opacity: .8">
                  <span class="brand-text font-weight-dark">DigitalMarket</span>
                  <small class="float-right">Fecha: {{$pedido->created_at->format('d-m-Y')}}</small>
                </h4>p
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                De
                <address>
                  <strong>DigitalMarket.</strong><br>
                  Av. Frocencio Gimenez<br>
                  Barquisimeto,Lara<br>
                  Telefono: (414) 956-8272<br>
                  Correo: apolosoft3@gmail.com
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4  invoice-col">
                A
                <address>
                  <strong>{{$pedido->direccionFactura->nombre}} {{$pedido->direccionFactura->apellido}}</strong><br>
                  {{$pedido->direccionFactura->estado}}<br>
                  {{$pedido->direccionFactura->municipio}}<br>
                  {{$pedido->direccionFactura->parroquia}}<br>
                  {{$pedido->direccionFactura->zona}}<br>
                  {{$pedido->direccionFactura->direccionExacta}}<br>
                  {{$pedido->direccionFactura->puntoReferencia}}<br>
                  {{$pedido->direccionFactura->primerTelefono}}<br>
                  {{$pedido->direccionFactura->segundoTelefono}}<br>
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col float-right ">
                <b>Factura #{{$pedido->codigo}} 
                  <span style="float: right;"><?php echo  DNS1D :: getBarcodeHTML ($pedido->id , 'C39' );?> </span> </b><br>
                <br>
                <b>Pedido ID:</b> {{$pedido->id}} <br>
                <b>Fecha de pago:</b> {{$pedido->created_at->format('d-m-Y')}}<br>
                <b>Comprador ID:</b> {{$pedido->comprador->id}}
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $subTotal=0;
                    ?>
                    @foreach ($pedido->producto as $item)

                    <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->nombre}}</td>
                      <td>{{$item->pivot->cantidadProducto}}</td>
                      <td>Bs {{$item->pivot->precioProducto}}</td>
                      <td>Bs {{$item->pivot->precioProducto*$item->pivot->cantidadProducto}}</td>
                    </tr>
                    <?php
                      $subTotal=$subTotal+($item->pivot->precioProducto*$item->pivot->cantidadProducto)
                    ?>
                    @endforeach

                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <div class="col-6">
                <p class="lead">Medios de pagos:</p>
                @foreach ($pedido->metodoPago as $item)

                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                  <strong>{{$item->nombre}}</strong><br>
                  Moneda: {{$item->moneda}}<br>
                  Monto a pagado: @if($item->moneda=='Bolivares') Bs @else $ @endif {{$item->pivot->cantidad}}
                </p>

                @endforeach
              </div>
              <!-- /.col -->
              <div class="col-6">


                <div class="table-responsive">
                  <table class="table">
                    <tr>
                            
                      <th style="width:50%">Total</th>
                      <td> 
                        Bs {{ $subTotal}}
                      </td>
                    </tr>
                    <tr>
                      <th>Costo de envio</th>
                      <td>
                        @if($pedido->precioEnvio!='0')
                          Bs{{$pedido->precioEnvio}}
                          @else
                          Envio gratis
                        @endif
                      </td>
                    </tr>
                    @if(!empty($pedido->codigoCupon))
                    <tr>
                      <th>Cupón:</th>
                      <td> Bs {{$pedido->cantidadCupon}}</td>
                    </tr>
                    @endif
                    @if(!empty($pedido->descuentoAficional))
                    <tr>
                      <th>Descuento adicional:</th>
                      <td>Bs {{$pedido->descuentoAficional}}</td>
                    </tr>
                    @endif
                    <tr>
                      <th>Monto Total:</th>
                      <td><span>Bs {{$pedido->montoTotal}}</span></td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
     

</body>
</html>
