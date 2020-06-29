@extends('layouts.frondTienda.design')
@section('contenido')
@php
use App\Producto;
use App\Categoria;
use App\Marca;
@endphp
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.frondTienda.sider')
            </div>
            
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">
                       @if(count($producto)<=0)
                       No hay resultados
                       @else
                       Resultados encontrados ({{count($producto)}})
                       @endif
                    </h2>

                    @foreach ($producto as $productos)
                        
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                    <div class="productinfo text-center">
                                        @if($productos->imagen->count()<=0)
                                            <img  src="/imagenes/avatar.png" >
                                        @else
                                            <img src="{{$productos->imagen->random()->url}}" >
                                        @endif
                                    <h2>Bs {{$productos->precioActual}}</h2>
                                    @if($productos->porcentajeDescuento!=0)
                                    <h4>Bs {{$productos->precioAnterior}}</h4>
                                    @endif
                                        <p>{{$productos->nombre}}</p>
                                    <a href="{{url('/detalleProducto/'.$productos->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Ver detalles</a>
                                    </div>
                                   
                            </div>
                            
                        </div>
                        </div>
                    @endforeach
                    <div align="center">{{$producto->links()}}</div> 
                    
            </div>
        </div>
    </div>
</section>

@endsection