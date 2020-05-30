@php
    use App\Http\Controllers\Controller;
    $mainCategorias=Controller::mainCategorias();
@endphp

<header id="header"><!--header-->
  
    

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{url('/')}}" class="active">Inicio</a></li>
                            @foreach($mainCategorias as $item)
                            <li class="dropdown"><a href="{{route('main.categorias.productos',$item->slug)}}">{{$item->nombre}}<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    
                            @foreach($item->subCategoria as $sub)    
                                <li><a href="{{route('categorias.productos',$sub->slug)}}">{{$sub->nombre}}</a></li>
                                        
                            @endforeach       
                                    
                                </ul>
                            </li> 
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Buscar producto"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->