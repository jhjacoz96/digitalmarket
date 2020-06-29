<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Hola {{$nombre}}, queremos recompensarte por ser parte del grupo de DigtalMarket. Es por ello que te regalaremos un cupón de descuento de {{$cupon->cantidad}} @if($cupon->tipoCupon=='Porcentaje') % @else Bs @endif. Esperamos que lo disfrutes.</p><br>
    <p>Código del cupón: {{$cupon->codigoCupon}}.<p><br>
    <p>Debe usarlo ante del {{$cupon->fechaExpiracion}}.<p><br>
    @if($cupon->tipoCupon=='Porcentaje')
    <p>Este cupón será aplicaciado sobre el monto total carrito.<p><br>
    <!--<p>Este prodrá usarlo sobre el monto total del carrito, si lo supera, el resto podrá aplicarlo en otro pedido.<p><br>-->
    @else
    <p>Este cupón será aplicaciado sobre el monto total carrito.<p><br>
    @endif
</body>
</html>