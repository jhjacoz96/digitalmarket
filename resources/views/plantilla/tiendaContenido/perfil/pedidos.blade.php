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
                <li class="active">Pedidos</li>
            </ol>
        </div> 
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading" align="center">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID orden</th>
                        <th>Productos pedidos</th>
                        <th>Metodos de pagos</th>
                        <th>Monto total</th>
                        <th>Fecha de solicitud</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedido as $item)
                        
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{count($item->producto)}}</td>
                        <td>
                            @foreach ($item->metodoPago as $item1)
                                {{$item1->nombre}}<br>
                            @endforeach
                        </td>
                        <td>{{$item->montoTotal}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <a class="btn btn-default" href="{{url('/comprador/pedidoDetalle/'.       $item->id)}}">
                                Ver detalle
                            </a>
                        </td>
                    </tr>
                    @endforeach
                   
                </tbody>
             
            </table>
        </div>
    </div>
</section>

@endsection

