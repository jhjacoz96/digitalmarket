@extends('layouts.frondTienda.design')
@section('contenido')

@php
    use App\Producto;
    use App\Combinacion;
@endphp

<section id="cart_items">
    <div class="container">
        <div class="p-2">
            @include('flash::message')
        </div>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Gracias</li>
            </ol>
        </div> 
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading" align="center">
            <h3>Su pedido ha sido solicitado</h3>
            <p>Su código de pedido es {{\Session::get('pedido_id')}} y el monto total por pagar es {{Session::get('montoTotal')}} </p>
        </div>
       
    </div>
</section><!--/#do_action-->

@endsection

@php
    Session::forget('pedido_id');
    Session::forget('montoTotal');
@endphp