@extends('plantilla.tiendaContenido.filtrarProductoCategoria')
@section('categoria')
@php
    use App\Producto;
@endphp


<div class="col-sm-3">
    @include('layouts.frondTienda.sider')
</div>

<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->

   
          
        <h2 class="title text-center">
                        
            {{$mainCategoria->nombre}}
            
            </h2>
            @foreach ($mainCategoria->subCategoria as $subCategorias)
            
        
            @foreach ($subCategorias->producto as $productos)
                
            
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
                
            @endforeach
            
              
      
        
        
        
    </div><!--features_items-->
    
    
    
</div>

















@endsection


