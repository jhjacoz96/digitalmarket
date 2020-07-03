@extends('layouts.frondTienda.design')

@section('contenido')

@php
use App\Producto;
@endphp

<section id="slider">
    <!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($banner as $key=> $item)
                        <li data-target="#slider-carousel" data-slide-to="0" @if($key==0) class="active" @endif></li>
                        @endforeach
                    </ol>

                    <div class="carousel-inner">
                        @foreach ($banner as $key=> $item)

                        <div class="item @if($key==0) active @endif">
                            <a href="{{$item->imagen->link}}" title="{{$item->titulo}}"><img
                                    src="{{$item->imagen->url}}" alt=""></a>

                        </div>
                        @endforeach


                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
<!--/slider-->

<section>
    <div class="container">
        <div class="row">
            
             

            <div class="col-sm-3">
                @include('layouts.frondTienda.sider')
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center">Productos mas vistos</h2>
                     
                    @foreach ($producto as $productos)

                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    @if($productos->imagen->count()<=0) <img src="/imagenes/avatar.png">
                                        @else
                                        <img style="width: 150px; height: 150px; " src="{{$productos->imagen->random()->url}}">
                                        @endif
                                        <h2>Bs {{$productos->precioActual}}</h2>
                                        
                                        @if($productos->porcentajeDescuento!=0)
                                        <h4 style="text-decoration: line-through;">Bs {{$productos->precioAnterior}}</h4>
                                        @endif
                                        <p>{{$productos->nombre}}</p>
                                        <a href="{{url('/detalleProducto/'.$productos->slug)}}"
                                            class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Ver detalles</a>
                                </div>
                               
                            </div>
                            
                        </div>
                    </div>

                    @endforeach



                </div>
                <!--features_items-->

                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center">Productos en oferta</h2>
                     
                    @foreach ($productoOferta as $productos)

                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                  
                                    @if($productos->imagen->count()<=0) <img src="/imagenes/avatar.png">
                                    @else
                                    <img style="width: 150px; height: 150px; " src="{{$productos->imagen[0]->url}}">
                                    @endif

                                        <h2>Bs {{$productos->precioActual}}</h2>
                                        @if($productos->porcentajeDescuento!=0)
                                        <h4 style="text-decoration: line-through;">Bs {{$productos->precioAnterior}}</h4>
                                        @endif
                                        <p>{{$productos->nombre}}</p>
                                        <a href="{{url('/detalleProducto/'.$productos->slug)}}"
                                            class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Ver detalles</a>
                                </div>
                               
                            </div>
                           
                        </div>
                    </div>

                    @endforeach



                </div>
                <!--features_items-->
               
                

                <div class="recommended_items">
                    <!--recommended_items-->
                    <h2 class="title text-center">Tiendas top</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                                $count=1;
                           ?> 
                           @foreach ($tienda->chunk(3) as $chunk)
                            
                            <div 
                            <?php if($count==1){  ?> 
                            
                            class="item active" <?php }else{ ?> class="item" <?php } ?>>

                                @foreach ($chunk as $item)  
                            
                            <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <a href="{{url('/productos/tienda/'.$item->id)}}">
                                                        @if($item->imagen==null)
                                                        <img src="{{asset('/imagenes/tienda/tienda.png')}}" style="border-radius: 100px;" alt="" />
                                                        @else
                                                        <img src="{{$item->imagen->url}}" style=" width: 150px;" alt="" />
                                                        @endif
                                                    </a>
                                                    
                                                <h5 >{{$item->nombreTienda}}</h5>    
                                            
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                               
                            </div>
                            
                            <?php
                                $count++;
                                ?> 

                            @endforeach
                        </div>
                         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <!--/recommended_items-->

            </div>
        </div>
    </div>
</section>

@endsection