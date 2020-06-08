@extends('layouts.appAdmin')
@section('contenido')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Factura</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active">Factura</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

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
                  <i class="fas fa-globe"></i> DigitalMarket
                  <small class="float-right">Fecha: {{$pedido->created_at->format('d-m-Y')}}</small>
                </h4>
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
              <div class="col-sm-4 invoice-col">
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
              <div class="col-sm-4 invoice-col">
                <b>Factura #{{$pedido->id}}</b><br>
                <br>
                <b>Pedido ID:</b> {{$pedido->id}}<br>
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
                      <td>{{$item->cantidad}}</td>
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
                <p class="lead">Métodos de pagos:</p>
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
                <p class="lead">Amount Due 2/22/2014</p>

                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Subtotal:</th>
                      <td>Bs {{$subTotal}}</td>
                    </tr>
                    <tr>
                      <th>Gastos de envío</th>
                      @if($pedido->medioEnvio->precioEnvio==0)
                      <td>Gratis</td>
                      @else
                      <td>Bs {{$pedido->medioEnvio->precioEnvio}}</td>
                      @endif
                    </tr>
                    @if(!empty($pedido->cantidadCupon))
                    <tr>
                      <th>Monto por cupón:</th>
                      <td>Bs {{$pedido->cantidadCupon}}</td>
                    </tr>
                    @endif
                    <tr>
                      <th>Total:</th>
                      <td>Bs {{$subTotal+$pedido->medioEnvio->precioEnvio-$pedido->cantidadCupon}}</td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-12">

              <form action="{{url('/imprimir-factura/'.$pedido->id)}}" method="get">
                  <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </form>
              </div>
            </div>
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection