<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/adminlte/dist/css/adminlte.min.css')}}">
  
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <table width="700px" border="0" cellpadding="0">  
        <tr><td><img src="{{asset('/shop/images/home/logo.png')}}" alt=""></td></tr> 
        <tr><td>&nbsp;</td></tr>
    <tr><td>Hola {{$nombre}}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Gracias por su compra con nosotros</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>El pago de su pedido debe hacerlos a través de los siguientes medios de pago:</td></tr>    
        <tr><td>&nbsp;</td></tr>
        <tr><td>
            <div class="row">
            @foreach ($detalleProducto['metodoPago'] as $pago)

                <div class="col-sm-4 mt-2">
                    <address>
                        <strong>{{$pago->nombre}}</strong><br>
                        Tipo de pago: {{$pago->tipoPago}}<br>
                        Moneda: {{$pago->moneda}}<br>
                        @empty(!$pago->telefono)    
                        Telefono: {{$pago->telefono}}<br>
                        @endempty
                        @empty(!$pago->correo)    
                        Correo: {{$pago->correo}}<br>
                        @endempty

                       @if(!empty($pago->bancoMetodoPago))
                        Cuenta bancaria:<br>
                        @empty(!$pago->bancoMetodoPago->nombreBanco)
                            Nombre del banco: {{$pago->bancoMetodoPago->nombreBanco}}<br>
                        @endempty
                        @empty(!$pago->bancoMetodoPago->titular)      
                            Titular de la cuenta: {{$pago->bancoMetodoPago->titular}}<br>
                        @endempty
                        @empty(!$pago->bancoMetodoPago->detalleCuenta)    
                            Número de cuenta: {{$pago->bancoMetodoPago->detalleCuenta}}<br>
                        @endempty   
                        @empty(!$pago->bancoMetodoPago->documentoIdentidad)    
                            Documento de identidad: {{$pago->bancoMetodoPago->tipoDocumento}}{{$pago->bancoMetodoPago->documentoIdentidad}}<br>
                        @endempty
                        @empty(!$pago->bancoMetodoPago->tipoCuenta)  
                            Tipo de cuenta: {{$pago->bancoMetodoPago->tipoCuenta}}<br>
                        @endempty
                       @endif
                        
                    </address>
                </div>
            
            @endforeach
            </div>
        </td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Los detalles de su pedido son los siguientes;-</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Pedido No: {{$detalleProducto['id']}}</td></tr>
        <tr><td>&nbsp;</td></tr>

        <tr><td>
            <table width="95%" cellpadding="5" cellspacing="5" bgcolor="#e0d9d9" >
                <tr bgcolor="#cccccc">
                    <td>Producto</td>
                    <td>Cantidad</td>
                    <td>Precio unitario</td>
                    <td>Precio total</td>
                </tr>
                @foreach ($detalleProducto['producto'] as $producto)
                <tr>
                    <td>{{$producto->nombre}}</td>
                    <td>{{$producto->pivot->cantidadProducto}}</td>
                    <td>{{$producto->pivot->precioProducto}}</td>
                    <td>{{$producto->pivot->precioProducto*$producto->pivot->cantidadProducto}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5" align="right">Gastos de envio</td>
                    
                    @if($detalleProducto['precioEnvio']=='0')
                    <p>Envío grátis</p>
                    @else
                    <td >Bs {{$detalleProducto['precioEnvio']}}</td>
                    @endif
            
                </tr>
                @if(!empty($detalleProducto['codigoCupon']))
                <tr>
                    <td colspan="5" align="right">Cupón de descuento</td>
                    <td >BS {{$detalleProducto['cantidadCupon']}}</td>
                </tr>
                @endif
               
                    @if(!empty($detalleProducto['codigoCupon']))
                <tr>
                    <td colspan="5" align="right">Cupón de descuento</td>
                    <td >BS {{$detalleProducto['cantidadCupon']}}</td>
                </tr>
                @endif
                
                @if(!empty($detalleProducto['descuentoAdicional']))
                <tr>
                    <td colspan="5" align="right">Descuento adicional</td>
                    <td >BS {{$detalleProducto['descuentoAdicional']}}</td>
                </tr>
                @endif
                <tr>
                    <td colspan="5" align="right">Monto total</td>
                    <td >BS {{$detalleProducto['montoTotal']-$detalleProducto['cantidadCupon']+$detalleProducto['medioEnvio']->precioEnvio}}</td>
                </tr>
            </table>
        </td></tr>
        <tr><td>
            <table width="100%">
                <tr>
                    <td width="50%">
                        <table>
                            <tr>
                                <td> <strong>Enviar a :</strong>  </td>
                            </tr>
                            <tr>
                                <td>{{$direccionEnvio->nombre}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionEnvio->apellido}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionEnvio->direccionExacta}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionEnvio->puntoReferencia}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionEnvio->primerTelefono}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionEnvio->segundoTelefono}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionEnvio->observacion}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionEnvio->zona}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionEnvio->parroquia}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionEnvio->municipio}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionEnvio->estado}}</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table width="50%">
                            <tr>
                                <td> <strong>Factura a :</strong>  </td>
                            </tr>
                            <tr>
                                <td>{{$direccionFactura->nombre}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionFactura->apellido}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionFactura->direccionExacta}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionFactura->puntoReferencia}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionFactura->primerTelefono}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionFactura->segundoTelefono}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionFactura->observacion}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionFactura->zona}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionFactura->parroquia}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionFactura->municipio}}</td>
                            </tr>
                            <tr>
                                <td>{{$direccionFactura->estado}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td></tr>

        <tr><td>&nbsp;</td></tr>
        <tr><td>Para cualquier consultar conactanos en <a href="mailto:apolosofts3@gmail.com"></a>apolosofts3@gmail.com</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Saludos,<hr> Equipo de DigitalMarket</td></tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</body>
</html>