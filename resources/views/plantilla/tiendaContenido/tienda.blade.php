@extends('plantilla.tiendaContenido.filtrarProductoCategoria')
@section('categoria')
@php
    use App\Producto;
@endphp


<div class="col-sm-3">
    @include('layouts.frondTienda.sider')
</div>



<div class="col-sm-9 padding-right">
    
        <div class="row">
      
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        @if($tienda->imagen!=null)
                        <img  src="{{$tienda->imagen->url}}" style="width: 200px;" style="border-radius: 100px;" alt="" />
                        @else
                        <img src="{{asset('/imagenes/tienda/tienda.png')}}" style="border-radius: 100px;" alt="" />
                        @endif
                    </div>
                    <div class="col-sm-6 col-md-8">
                
                        <div class="col-sm-12">

                            <span style="font-size: 45px;" class=" pull-left title-heading">
                                {{$promedio}}
                            </span>
                        </div>
                        <div class="col-sm-12">
                            <p style="font-size: 22px;">
                                @if($formatPromedio==='5')
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                
                                @endif
                                @if($formatPromedio==='4')
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                
                                @endif
                                @if($formatPromedio==='3')
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                
                                @endif
                                @if($formatPromedio==='2')
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                
                                @endif
                                @if($formatPromedio==='1')
                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                
                                @endif
                            </p>
                            
                        </div>
                        
                        <div class="col-sm-12">
                            <p>
                                Promedio entre {{$countCalificacion}} @if($countCalificacion>1) comentarios @endif @if($countCalificacion<2) comentario @endif
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        
        </div>

        <div class="row">
            <div class="col-sm-12">
                <p>Calificaciones detallada</p>
                <p>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                   <span>({{$star5}})</span>
                </p>
                <p>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                    <span>({{$star4}})</span>
                </p>
                <p>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                    <span>({{$star3}})</span>
                </p>
                <p>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                    <span>({{$star2}})</span>
                </p>
                <p>
                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                    <span>({{$star1}})</span>
                </p>
            </div>
            
            

        </div>

    <div class="features_items"><!--features_items-->

   
          
        <h2 class="title text-center">
                        
            Productos de {{$tienda->nombreTienda}}
            
        </h2>
            @foreach ($producto as $productos)
      
            
                <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                            <div class="productinfo text-center">
                                @if($productos->imagen->count()<=0)
                                    <img  src="/imagenes/avatar.png" >
                                @else
                                    <img style="width: 150px; height: 150px;"  src="{{$productos->imagen->random()->url}}" >
                                @endif
                            <h2>Bs {{$productos->precioActual}}</h2>
                            @if($productos->porcentajeDescuento!=0)
                            <h4 style="text-decoration: line-through;">Bs {{$productos->precioAnterior}}</h4>
                            @endif
                                <p>{{$productos->nombre}}</p>
                                <a href="{{url('/detalleProducto/'.$productos->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Ver detalles</a>
                            </div>
                            
                    </div>
                   
                </div>
                </div>
        
            @endforeach
            <div align="center">{{$producto->links()}}</div> 
        
    
    </div><!--features_items-->
    

</div>

@endsection


