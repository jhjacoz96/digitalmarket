<div class="left-sidebar">
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->

        @foreach ($categoria as $categorias)
            
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" href="#{{$categorias->id}}">
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        {{$categorias->nombre}}
                    </a>
                </h4>
            </div>
            <div id="{{$categorias->id}}" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        @foreach ($categorias->subCategoria as $subCategorias)
                            <li><a href="{{route('categorias.productos',$subCategorias->slug)}}">{{$subCategorias->nombre}}</a></li> 
                        @endforeach
                       
                    </ul>
                </div>
            </div>
        </div>

        @endforeach
        
    </div><!--/category-products-->


    
</div>