<?php
 
    $mesActual=date('M');
    $mesPasado=date('M',strtotime("-1 month"));
    $mesAnteActual=date('M',strtotime("-2 month"));

$dataPoints = array(
	array("y" =>$compradorMesActual,"label" => $mesActual),
	array("y" =>$compradorMesPasado,"label" =>  $mesPasado),
	array("y" =>$compradorSegundoMesPasado,"label" => $mesAnteActual)
);
 
?>

@extends('layouts.appAdmin')

<script>
  window.onload = function () {
   
  var chart = new CanvasJS.Chart("chartContainer", {
    title: {
      text: "Reporte de compradores"
    },
    axisY: {
      title: "Cantidad de compradores"
    },
    data: [{
      type: "line",
      dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
  });
  chart.render();s
   
  }
</script>

@section('contenido')


    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Reportes</h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Consultar</li>
            </ol>
        </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
      <!-- Main content -->
      <section class="content">


        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="p-2">
                  @include('flash::message')
               </div>

                <div class="card-header">
                  <h3 class="card-title">Consultar Comprador</h3>
                </div>
                
                <div class="card-body">
               
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                  
                </div>
                
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->


      </section>
   
    </div>

  
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection