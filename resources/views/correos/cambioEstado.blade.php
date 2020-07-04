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
        <p>Hola {{$nombre}}, queremos informate que tus productos ya se encuentran en nuestro almacén; listo y verificado. Una vez su pedido esté listo para el envío, se le notificará por este medio.</p>
    @endif

    @if($pedido->status=='cancelado')
    <p>Código de pedido: {{$pedido->id}}</p>
    <p>Estado del pedido: Pedido cancelado</p>
    &nbsp;
        <p>Hola {{$nombre}}, lamentamos informarte informate que su pedido ha sido candelado ya que se ha vencído el plazo de espera del pago.</p>
    @endif


    @if($pedido->status=='enviadoComprador')
    <p>Código de pedido: {{$pedido->id}}</p>
    <p>Estado del pedido: Enviado al comprador</p>
    <p>Referencia de envio: {{$pedido->refenciaEnvio}}</p>
    &nbsp;
        <p>Hola {{$nombre}}, queremos informate que tu pedido ya ha sido envido a la dirección que usted ha indicado. Esperamos que disfrute sus productos y gracias por preferirnos.</p>   
    &nbsp;

        <p>Nota: No debe olvidar calificar los productos de su pedido. Si no se realiza calificación, su pedido será culminado por nosotros.</p>
    @endif
</body>
</html>