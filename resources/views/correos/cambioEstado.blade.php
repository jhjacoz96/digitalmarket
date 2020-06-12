<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    @if($pedido->status=='preparandoPedido')
    <p>Código de pedido: {{$pedido->id}}</p>
    <p>Estado del pedido: Preparando pedido</p>
    &nbsp;
        <p>Hola {{$nombre}}, queremos informate que tus productos ya se encuentran en nuestro almacen; listos y verificados. Una vez su pedido este listo para el envio, se notificará por este medio.</p>
    @endif

    @if($pedido->status=='enviadoComprador')
    <p>Código de pedido: {{$pedido->id}}</p>
    <p>Estado del pedido: Enviado al comprador</p>
    &nbsp;
        <p>Hola {{$nombre}}, queremos informate que tu pedido ya ha sido envido a la dirección que usted ha indicado. Esperamos que disfrute sus productos y gracias por preferirnos.</p>
    &nbsp;
        <p>Nota: No debe olvidar calificar los productos de su pedido. Si no se realiza esta, su pedido será culminado por nosotros.</p>
    @endif
</body>
</html>