@extends('layouts.appAdmin')
@section('scripts')

@endsection
@section('estilos')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('tablaPrecio/tablaPrecio.css') }}">
@endsection
@section('contenido')
<div id='multi'>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="p-2">
      @include('flash::message')
   </div>
      <!-- Main content -->
      <section class="content">

        <div class="row"> 
          
          


            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                
                <h3>{{$nowPedido}}</h3>

                  <p>Nuevos pedidos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('tiendas.pedido.consultar')}}" class="small-box-footer">Ver detalles<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                
                <h3>{{$productoStock}}</h3>
                  
                  <p>Productos sin stock</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('tiendas.producto.index')}}" class="small-box-footer">Ver detalles<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header border-0">
                 
                    <h3 class="card-title">Planes de afiliación</h3>
                    
                  
                </div>
                <div class="card-body">
                  <div class="row">
                    <title></title>
                  </div>

                  <div class="wrap">
                    
                    <div class="pricing-wrap">
                     
                    @foreach ($plan as $item)
                        
                    
                        <div class="pricing-table  shadow-lg  bg-white rounded">
                          <div class="pricing-table-cont">
                            <div class="pricing-table-month">
                              <div class="pricing-table-head  @if($item->nombre!='Gratuita')estandar-title @endif">
                                <h2>{{$item->nombre}}</h2>
                                <h3><sup>Bs</sup>{{$item->precio}}<sub></sub></h3>
                              </div>
                              <ul class="pricing-table-list">
                              <li>{{$item->descripcion}}</li>
                                <li>Nivel del exposión: <span>{{$item->exposicion}} </span></li>
                              <li>Stock por productos: <span>@if($item->tiempoPublicacion=='') Ilimitado @else{{$item->tiempoPublicacion}}@endif</span></li>
                                <li>Publicaciones activas: <span>
                                  @if($item->cantidadPublicacion=='') Ilimitado @else{{$item->cantidadPublicacion}}@endif
                                  </span></li>
                                <li>Mayor visibidad</li>
                                <li><span></span></li>
                              </ul>
                              @if($item->nombre!='Gratuita')
                              <form action="{{url('/tiendas/cambiar-plan/'.$item->id)}}" method="get">
                                <div class="form-group">
                                    
                                    <button type="submit" onclick="return confirm('¿Esta seguro que sea cambiar el plan de afiliación?')" class="pricing-table-button estandar ">!Afiliarme¡</button>
                                  
                                </div>
                              </form>
                              @endif

                            </div>
                          </div>
                        </div>


                     

                        @endforeach
                      
                     
                 
                    </div>
                  </div>




<!-- Modal -->
                
        
                

                </div>
              </div>
            </div>
          </div>
          
        


      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div>
</div>
@endsection