@php
    use App\Producto;
    use App\Marca;
@endphp
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
                        <li><a
                                href="{{route('categorias.productos',$subCategorias->slug)}}">{{$subCategorias->nombre}}</a>
                            ({{$count}})</li>

                        @endforeach

                    </ul>
                </div>
            </div>
        </div>

        @endforeach

       
    </div><!--/category-products-->

    <div class="brands_products"><!--brands_products-->
        <h2>Marcas</h2>
        <div class="brands-name">
            <ul class="nav nav-pills nav-stacked">
                @foreach ($marca as $item)
                @php
                $count=Producto::marcaCount($item->id);
                @endphp    
                    <li><a href="{{route('marca.show',$item->id)}}"> <span class="pull-right">({{$count}})</span>{{$item->nombre}}</a></li>
                @endforeach
            </ul>
        </div>
    </div><!--/brands_products-->
    
    
</div>