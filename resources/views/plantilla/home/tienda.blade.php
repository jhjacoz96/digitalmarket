@extends('layouts.appAdmin')

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

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div>
</div>
@endsection