<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <strong>Pago de pedido:</strong>  
    &nbsp;

    <p>Hola {{$nombre}}, se le informa que el pago por el pedido {{$pedido}} a sido realizado con exito por un monto de Bs{{$pagoTiendaPedido->montoPagado}}. Para mas detalles puede ingresar a los detalles del pedido en su panel de administración.</p>
    &nbsp;
    <p>Gracias por preferirnos - DigialMarket</p>
    &nbsp;
</body>
</html>