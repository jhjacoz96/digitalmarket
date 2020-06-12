@extends('layouts.frondTienda.design')
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
              <li class="active">Lista de deseos</li>
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
                    @foreach ($listaDeseo as $item)
                        
                    @php
                        $producto=Producto::where('id',$item->producto_id)->first();
                        if($producto->tipoCliente=='combinacion'){
                            $combinacion=Combinacion::where('id',$item->combinacion_id)->first();
                        }
                    @endphp

                        <tr>
                            <td class="cart_product">
                            <a href="">
                                @if($producto->imagen->count()<=0)
                                <img style="width: 100px;"  src="/imagenes/avatar.png" >
                                 @else
                                 <img style="width: 100px;"
                               
                                 src="{{$producto->imagen->random()->url}}" >
                                @endif
                               </a>
                            </td>
                            <td class="cart_description">

                            <h4><a href="">{{$producto->nombre}}</a></h4>
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
                              
                               {{$item->cantidad}}
                              
                                </div>
                            </td>
                            <td class="cart_total">
                            <p class="cart_total_price">Bs{{$item->precio*$item->cantidad}}</p>
                            </td>
                            <td class="cart_delete">

                            <form action="{{route('agregarCarrito')}}" method="post">
                                {{ csrf_field() }} 
     
                                <input type="hidden" name="producto_id" value="{{$item->producto_id}}">
                                <input type="hidden" name="precio" value="{{$item->precio}}">
                                <input type="hidden" name="cantidad" value="{{$item->cantidad}}">

                                @if($producto->tipoCliente=='combinacion')
                                <input type="hidden" name="combinacion_id" value="{{$item->combinacion_id}}">
                                @endif

                                <button class="btn btn-default cart" name="carritoBoton" value="agregar a carrito" type="submit"> <i class="fa fa-shopping-cart"></i> Agregar a carrito</button>
                                
                                <a class="cart_quantity_delete" href="{{url('/lista-deseo/eliminar/'.$item->id)}}"><i class="fa fa-times"></i></a>
                            </form>

                            </td>
                        </tr>

                    @endforeach
                     
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

@endsection