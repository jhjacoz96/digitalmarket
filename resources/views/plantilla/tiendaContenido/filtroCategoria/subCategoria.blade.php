@extends('plantilla.tiendaContenido.filtrarProductoCategoria')

@section('categoria')

@php
    use App\Producto;
@endphp


<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Categorias</h2>
        
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->

            @foreach ($categoria as $categorias)
                
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$categorias->slug}}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{$categorias->nombre}}
                        </a>
                    </h4>
                </div>
                <div id="{{$categorias->slug}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach ($categorias->subCategoria as $subCategorias)
                            @php
                                $count=Producto::productoCount($subCategorias->id);
                            @endphp
                                <li><a href="{{route('categorias.productos',$subCategorias->slug)}}">{{$subCategorias->nombre}}</a> ({{$count}})</li>    

                            @endforeach
                           
                        </ul>
                    </div>
                </div>
            </div>

            @endforeach
            
        </div><!--/category-products-->
    
        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                    <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                    <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                    <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                    <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                    <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                    <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                </ul>
            </div>
        </div><!--/brands_products-->
        
  
    
    </div>
</div>

<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->

   
          
      
   
        <h2 class="title text-center">
                        
            {{$subCategoria->nombre}}
            
        </h2>
        @foreach ($subCategoria->producto as $productos)
            
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
                                <p>{{$productos->nombre}}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                            </div>
                             <div class="product-overlay">
                                <div class="overlay-content">
                                    <h2>Bs {{$productos->precioActual}}</h2>
                                    <p>{{$productos->nombre}}</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        
        @endforeach
     
              
      
        
        
        
    </div><!--features_items-->
    

    
</div>










    


@endsection
