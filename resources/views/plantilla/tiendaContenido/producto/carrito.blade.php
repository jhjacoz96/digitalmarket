@extends('layouts.frondTienda.design')
@section('script')
    <script>
       
        $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
    </script>
@endsection
@section('contenido')

@php
    use App\Producto;
    use App\Combinacion;
@endphp

<section id="cart_items">
    <div class="container">
        <div class="p-2">
            @include('flash::message')
        </div>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Carrito</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Producto</td>
                        <td class="description"></td>
                        <td class="price">Precio</td>
                        <td class="quantity">Cantidad</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $montoTotal=0;
                    @endphp
                    @foreach ($userCarrito as $item)
                        
                    @php
                        $producto=Producto::where('id',$item->producto_id)->with('combinacion')->first();
                        if($producto->tipoCliente=='combinacion'){
                            $combinacion=Combinacion::where('id',$item->combinacion_id)->first();
                        }
                    @endphp

                        <tr>
                            <td class="cart_product">
                               
                            <a href="{{'/detalleProducto/'.$producto->slug}}">
                                @if($producto->imagen->count()<=0)
                                <img style="width: 100px;"  src="/imagenes/avatar.png" >
                                 @else
                                 <img style="width: 100px;"
                               
                                 src="{{$producto->imagen[0]->url}}" >
                                @endif
                               </a>
                            </td>
                            <td class="cart_description">

                            <h6><a href="{{'/detalleProducto/'.$producto->slug}}">{{$producto->nombre}}</a></h6>
                                @if($producto->tipoCliente=='combinacion')
                               
                                <p>
                                @foreach ($combinacion->atributo as $items)
                                    
                                {{$items->grupoAtributo->nombre}}: {{$items->nombre}} |

                                @endforeach
                            </p>
                                @endif
                            </td>
                            <td class="cart_price">
                            <p>Bs{{$item->precio}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="{{url('/carrito/actualizarCantidad/'.$item->id.'/1')}}"> + </a>
                                <input class="cart_quantity_input" type="text" name="cantidad" value="{{$item->cantidad}}"  autocomplete="off" size="2">
                                @if($item->cantidad>1)
                                    <a class="cart_quantity_down" href="{{url('/carrito/actualizarCantidad/'.$item->id.'/-1')}}"> - </a>
                                @endif
                                </div>
                            </td>
                            <td class="cart_total">
                            <p class="cart_total_price">Bs{{$item->precio*$item->cantidad}}</p>
                            </td>
                            <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{route('carrito.eliminarProducto',$item->id)}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <?php $montoTotal=$montoTotal+($item->precio*$item->cantidad);?>

                    @endforeach
                     
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>¿Posees un cupón de descuento?</h3>
            <p>Aquí podrás indicar el código del cupón.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                
                        <li>
                        <form action="{{route('carrito.aplicarCupon')}}" method="post">
                            @csrf
                                <label>Código de cupón:</label>
                                <input type="text" name="codigoCupon">
                                <input type="submit" class="btn btn-default " value="Aplicar">
                        </form>
                        
                        </li>
                        {!!$errors->first('codigoCupon','<small>:message</small><br>')!!}
                    </ul>
                   
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        @if(!empty(Session::get('montoCupon')))

                        <li>Sub total del carrito<span>Bs<?php echo $montoTotal; ?></span></li>

                        <li>Descuento por cupón<span>Bs<?php echo \Session::get('montoCupon');?></span></li>
                        
                            @if (!empty(\Session::get('$montoDescuentoTipoComrador')))
                                
                            <li>Descuento adicional<span>Bs<?php echo \Session::get('$montoDescuentoTipoComrador');?></span></li>
                            
                            @endif
                       
                        <?php
                       $moneda=Producto::obtenerMoneda($montoTotal-\Session::get('montoCupon')-\Session::get('$montoDescuentoTipoComrador'));
                        ?>

                        <li>Monto total<span>Bs<?php echo $subMonto=$montoTotal- \Session::get('montoCupon')-\Session::get('$montoDescuentoTipoComrador'); ?></span></li>

                       @else

                       
                        @if(\Auth::check())
                            @if(\Auth::user()->comprador->tipoComprador->envioGratis===1)
                            <li>Medio de envio<span> Envio gratis</span></li>
                            @endif
                        @endif
                       <li>Sub total del carrito<span>Bs<?php echo $montoTotal; ?></span></li>

                        @if (!empty(\Session::get('$montoDescuentoTipoComrador')))
                            <li>Descuento adicional<span>Bs<?php echo \Session::get('$montoDescuentoTipoComrador');?></span></li>
                        @endif

                       <?php
                       $moneda=Producto::obtenerMoneda($montoTotal-\Session::get('$montoDescuentoTipoComrador'));
                    ?>
                   

                    

                    <li>Monto total<span>Bs<?php echo $subMonto=$montoTotal-\Session::get('$montoDescuentoTipoComrador')-\Session::get('montoCupon'); ?>
                       
                    </span></li>

                        @endif
                        <li>Monto total<span>@foreach ($moneda['nombre'] as $nombre){{$nombre}}@endforeach @foreach ($moneda['monto'] as $monto){{$monto}}@endforeach
                        </span></li>
                        
                        
                    </ul>
                   
                <a class="btn btn-default check_out" href="{{url('/checkout/'.$subMonto)}}">Procesar compra</a>
                
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

@endsection