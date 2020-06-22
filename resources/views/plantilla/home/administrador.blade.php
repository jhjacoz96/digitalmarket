@extends('layouts.appAdmin')
@section('scripts')
<script src="{{asset('/reportes/reportes.js')}}" defer></script>
@endsection
@section('contenido')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrador</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="justify-content-between">
                  <h3 class="card-title">Estados</h3>
                  
                </div>
              </div>
  
              <div class="card-body">
                
                <div class="row">
                  
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                      <div class="inner">
                       
                        <h3> {{$countEt}}</h3>
        
                        <p>Espera por pago</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-bag"></i>
                      </div>
                      <a href="{{route('pedido.consultar','esperaTransferencia')}}" class="small-box-footer">Ver detalles<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">
                      <h3>{{$countPa}}</h3>
        
                        <p>Pago aceptado</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-bag"></i>
                      </div>
                      <a href="{{route('pedido.consultar','pagoAceptado')}}" class="small-box-footer">Ver detalles<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                      <h3>{{$countPp}}</h3>
        
                        <p>Preparando pedido</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-bag"></i>
                      </div>
                      <a href="{{route('pedido.consultar','preparandoPedido')}}" class="small-box-footer">Ver detalles<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box" style="background-color:deeppink; color: floralwhite;" >
                      <div class="inner">
                        <h3>{{$countEc}}</h3>
        
                        <p>Pedido enviado</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-bag"></i>
                      </div>
                      <a href="{{route('pedido.consultar','enviadoComprador')}}"  class="small-box-footer">Ver detalles<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box" style="background-color:blueviolet; color: floralwhite;">
                      <div class="inner">
                        <h3>{{$countCu}}</h3>
        
                        <p>Culminado</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-bag"></i>
                      </div>
                      <a href="{{route('pedido.consultar','recibido')}}" class="small-box-footer">Ver detalles<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                </div>
  
  
  
              </div>
            </div>
          </div>
        </div>




  
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header border-0">
                  <div class="justify-content-between">
                    <h3 class="card-title">Estadísticas por mes y año</h3>
                    
                  </div>
                </div>
                
                

                <div class="card-body">
                  
                  <div class="row">

                    

                    <div class=" form-group col-md-12">
                      <div class="row">
                        <div class="col-md-4">
                          <?php  $nombremes=array(" ","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"); ?>
                          <label>Año</label>
                          <select class="form-control" id="anio_sel"  onchange="cambiar_fecha_grafica();">

                            <option value="2016" >2016</option>
                            <option value="2017" >2017</option>
                            <option value="2018">2018</option>
                            <option value="2019" >2019</option>
                            <option value="2020" >2020</option>
                          </select>

                        </div>
                        <div class="col-md-4">
                          <label>Mes</label>
                          <select class="form-control" id="mes_sel" onchange="cambiar_fecha_grafica();" >
                            <option value="1">ENERO</option>
                            <option value="2">FEBRERO</option>
                            <option value="3">MARZO</option>
                            <option value="4">ABRIL</option>
                            <option value="5">MAYO</option>
                            <option value="6">JUNIO</option>
                            <option value="7">JULIO</option>
                            <option value="8">AGOSTO</option>
                            <option value="9">SEPTIEMBRE</option>
                            <option value="10">OCTUBRE</option>
                            <option value="11">NOVIEMBRE</option>
                            <option value="12">DICIEMBRE</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
            
                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Cantidad de registros</h3>
          
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="position-relative mb-4">
                            <div style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;" id="div_grafica_barras"></div>
                          </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      
                    </div>

                    <div class="col-md-6">
                      <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Cantidad de Pedidos</h3>
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="position-relative mb-4">
                            <div  style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;" id="div_grafica_torta_pedido"></div>
                          </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      
                    </div>

                    <div class="col-md-12">
                      <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Cantidad de afiliados a planes por mes</h3>
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="position-relative mb-4">
                            <div style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"  id="div_grafica_colum_plan"></div>
                          </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      
                    </div>
                    
                  </div>
                </div>
              </div>
              
          </div>
         

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection