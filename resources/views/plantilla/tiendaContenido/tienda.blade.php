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
                        <img src="{{asset('/imagenes/tienda/tienda.png')}}" style="border-radius: 100px;" alt="" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                    <h4>{{$tienda->nombreTienda}}</h4>               
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i>100% Comentarios (calificaciones)
                            <br />
                            
                           
                     
                    </div>
                </div>
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
                                    <img  src="{{$productos->imagen->random()->url}}" >
                                @endif
                            <h2>Bs {{$productos->precioActual}}</h2>
                            @if($productos->porcentajeDescuento!=0)
                            <h4>Bs {{$productos->precioAnterior}}</h4>
                            @endif
                                <p>{{$productos->nombre}}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Ver detalles</a>
                            </div>
                            
                    </div>
                   
                </div>
                </div>
        
            @endforeach
                
        
    
    </div><!--features_items-->
    
</div>

@endsection


