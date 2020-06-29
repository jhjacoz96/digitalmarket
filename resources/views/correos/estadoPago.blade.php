<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<strong>Estado de pago:</strong>  
&nbsp;
@if ($estado=='aceptado')    
<p>Hola {{$comprador->nombre}}, el pago por {{$metodoPago->nombre}} de su pedido No.{{$pedido->id}} ha sido verificado con exito.</p>
&nbsp;      
@else
<p>Hola {{$comprador->nombre}}, el pago por {{$metodoPago->nombre}} de su pedido No.{{$pedido->id}} ha sido rechazado, se le informa que debe verificar el código de pago y modificarlo.</p>
&nbsp;
@endif
@if($pedido->status!='pagoAceptado')
<p>Estamos a la espera de la confirmación del resto de sus pagos, para asi proceder a realizarle el envio de su pedido.</p>
&nbsp;
@else
<p>Se le informa que todos los pagos de su pedido se han realizado con exito. Su pedido ahora se encuenta en estado "Pago aceptado". Una vez los productos de su pedido se encuenten en nuestro almacen, el pedido pasará a preparación para el envio.</p>
&nbsp;
<p>Su factura ya se encuentra disponible en los detalles de su pedido.</p>
@endif
</body>
</html>