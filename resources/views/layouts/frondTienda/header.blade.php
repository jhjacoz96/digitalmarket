@php
    use App\Http\Controllers\Controller;
    $mainCategorias=Controller::mainCategorias();
    use App\Producto;
    $carritoCount=Producto::carritoCount();
@endphp

@section('script')
<script>
    function markNotificationAsRead($parametro){
	 
     $.get(`/t/${$parametro}`)
     
     }
</script>
@endsection

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
                    <a href="{{url('/')}}"><img width="60" src="{{asset('/imagenes/logo/logo.png')}}"/></a>
                    </div>
                    <div class="btn-group pull-right">
                        <!--
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
                         -->
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            
                        <li><a href="{{url('/lista-deseo')}}"><i class="fa fa-heart"></i>Lista de deseos</a></li>
                            
                            <li><a href="{{url('/carrito')}}"><i class="fa fa-shopping-cart"></i>Carrito
                                @if($carritoCount>0)
                            <span class="label label-warning">{{$carritoCount}}</span>
                                @endif
                            </a></li>
                            @if(empty(\Auth::check()))
                        <li><a href="{{url('/registrar-usuario')}}"><i class="fa fa-user"></i> Registrarse</a></li>
                        <li><a href="{{url('/iniciar-sesion')}}"><i class="fa fa-lock"></i>Iniciar sesión</a></li>
                            @else
                          
                            <li>
                               
                              <a href="#"class="dropdown-toggle"
                              aria-expanded="false"  data-toggle="dropdown">
                              <i class="fa fa-bell-o"></i>
                              @if(count(\Auth::user()->comprador->unreadNotifications))
                              
                              <span class="label label-warning">{{count(\Auth::user()->comprador->unreadNotifications)}}</span>
                            @endif
                            </a>
 
                              <ul class="dropdown-menu" role="menu">
                                <span class="dropdown-header">{{count(\Auth::user()->comprador->unreadNotifications)}} notificationes</span>

                                @foreach (\Auth::user()->comprador->unreadNotifications as $notificacion)
                                      
                                <div class="dropdown-divider"></div>

                                @if($notificacion->data["estado"]=='enviadoComprador')
                                    <li>
                                    <a href="{{url('/comprador/pedidoDetalle/'.$notificacion->data["pedido"])}}" onclick=" markNotificationAsRead('{{$notificacion->id}}')" class="dropdown-item">
                                            Pedido {{$notificacion->data["pedido"]}}:  enviado al comprado <span class="text-sm text-muted">{{$notificacion->created_at->diffForHumans()}}</span>
                                        </a>
                                    </li>
                                @endif
                             

                                @if($notificacion->data["estado"]=='pagoAceptado')
                                    <li>
                                    <a href="{{url('/comprador/pedidoDetalle/'.$notificacion->data["pedido"])}}" onclick=" markNotificationAsRead('{{$notificacion->id}}')" class="dropdown-item">
                                            Pedido {{$notificacion->data["pedido"]}}: pago aceptado <span class="text-sm text-muted">{{$notificacion->created_at->diffForHumans()}}</span>
                                        </a>
                                    </li>
                                @endif
                               

                                @if($notificacion->data["estado"]=='preparandoPedido')
                                    <li>
                                    <a href="{{url('/comprador/pedidoDetalle/'.$notificacion->data["pedido"])}}" onclick=" markNotificationAsRead('{{$notificacion->id}}')" class="dropdown-item">
                                            Pedido {{$notificacion->data["pedido"]}}: preparando pedido <span class="text-sm text-muted">{{$notificacion->created_at->diffForHumans()}}</span>
                                        </a>
                                    </li>
                                @endif
                                @endforeach

                                <div class="dropdown-divider"></div>

                                @foreach (\Auth::user()->comprador->unreadNotifications as $notificacion)

                                @if($notificacion->data["estado"]=='metodoPagoDenegado')
                                    <li>
                                    <a href="{{url('/comprador/pedidoDetalle/'.$notificacion->data["pedido"])}}" onclick=" markNotificationAsRead('{{$notificacion->id}}')" class="dropdown-item">
                                            Pedido {{$notificacion->data["pedido"]}}: pago denegado <span class="text-sm text-muted">{{$notificacion->created_at->diffForHumans()}}</span>
                                        </a>
                                    </li>
                                @endif

                                @if($notificacion->data["estado"]=='metodoPagoAceptado')
                                    <li>
                                    <a href="{{url('/comprador/pedidoDetalle/'.$notificacion->data["pedido"])}}" onclick=" markNotificationAsRead('{{$notificacion->id}}')" class="dropdown-item">
                                            Pedido {{$notificacion->data["pedido"]}}: pago denegado <span class="text-sm text-muted">{{$notificacion->created_at->diffForHumans()}}</span>
                                        </a>
                                    </li>
                                @endif

                                @endForeach

                                
                                    
                              </ul>
                          </li>
                        
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
                           
                            <li class="dropdown"><a href="#">Categorias principales<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    
                            @foreach($mainCategorias as $item)   
                                <li><a href="{{route('main.categorias.productos',$item->slug)}}">{{$item->nombre}}</a></li>
                                        
                            @endforeach       
                                    
                                </ul>
                            </li> 
                         
                            
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form action="{{url('/buscar-producto')}}" method="post">
                            @method('GET')
                            @csrf
                            <input type="text" name="nombre"  placeholder="Buscar producto"/>
                            <button  type="submit"  style="border:0px; height:33px; margin-left:-3px; background-color: orange ; color:ivory; ">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->