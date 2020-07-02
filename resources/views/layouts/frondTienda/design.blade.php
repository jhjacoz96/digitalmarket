<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Home | E-Shopper</title>
  
    <link href="{{asset('shop/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('shop/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('shop/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('shop/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('shop/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('shop/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('shop/css/responsive.css')}}" rel="stylesheet">
 
    <link href="{{asset('shop/easy-zoom/css/easyzoom.css')}}" rel="stylesheet">
    
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('shop/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('shop/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('shop/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('shop/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('shop/images/ico/apple-touch-icon-57-precomposed.png')}}">

    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

    @yield('style')

</head><!--/head-->

<body>
    @include('layouts.frondTienda.header') 

	@yield('contenido')
	
	@include('layouts.frondTienda.footer')

    
    <script src="{{asset('shop/js/jquery.js')}}"></script>
    <script src="{{asset('shop/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('shop/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('shop/js/price-range.js')}}"></script>
    <script src="{{asset('shop/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('shop/js/main.js')}}"></script>
    <script src="{{asset('shop/easy-zoom/js/easyzoom.js')}}"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://unpkg.com/vue-multiselect@2.1.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    
    
    @yield('script')
    <script src="{{ asset('js/app.js') }}" defer></script>
    

</body>
</html>