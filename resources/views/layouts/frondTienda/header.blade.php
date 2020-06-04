@php
    use App\Http\Controllers\Controller;
    $mainCategorias=Controller::mainCategorias();
@endphp

<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                       </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->
    
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                    <a href="{{url('/')}}"><img src="{{asset('shop/images/home/logo.png')}}" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>
                        
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            
                            <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a href="{{url('/carrito')}}"><i class="fa fa-shopping-cart"></i> Carrito</a></li>
                            @if(empty(\Auth::check()))
                        <li><a href="{{url('/registrar-usuario')}}"><i class="fa fa-user"></i> Registrarse</a></li>
                        <li><a href="{{url('/iniciar-sesion')}}"><i class="fa fa-lock"></i>Iniciar seción</a></li>
                            @else
                        <li><a href="{{url('/comprador/cuenta')}}"><i class="fa fa-user"></i>{{\Auth::user()->nombre}} {{\Auth::user()->apellido}}</a></li>
                        <li><a href="{{url('/salir')}}"><i class="fa fa-sign-out"></i>Salir</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

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