@extends('layouts.frondTienda.design')
@section('contenido')
<div id="login">
   

    <section id="form" style="margin-top: 20px;"><!--form-->
        
		<div class="container">
            <div class="p-2">
                @include('flash::message')
             </div>
            <div class="row">
                
                <div class="col-sm-4">
    
                        <div class="panel panel-info">
                            <div class="panel-heading ">
                                <h2><i class="fa fa-user" ></i></h2>
                                <h4>Mis datos</h4>
                            </div>
                            <div class="panel-footer">
                                <a href="{{url('/comprador/perfil/'.\auth::user()->id)}}">Ver detalles<i class="fa fa-arrow-circle-right pull-right" aria-hidden="true"></i></a>
                            </div>  
                            
                        </div>
                     
                </div>

                <div class="col-sm-4">
    
                        <div class="panel panel-success">
                            <div class="panel-heading ">
                                <h2><i class="fa fa-map-marker" ></i></h2>
                                <h4>Mis direcciones</h4>
                            </div>
                            <div class="panel-footer">
                                <a href="{{url('/comprador/direcciones/'.\auth::user()->id)}}">Ver detalles<i class="fa fa-arrow-circle-right pull-right" aria-hidden="true"></i></a>
                            </div>  
                            
                        </div>
                     
                </div>

                <div class="col-sm-4">
    
                        <div class="panel panel-warning">
                            <div class="panel-heading ">
                                <h2><i class="fa fa-shopping-cart"></i></h2>
                                <h4>Mis pedidos</h4>
                            </div>
                            <div class="panel-footer">
                                <a href="{{url('/comprador/pedidos')}}">Ver detalles<i class="fa fa-arrow-circle-right pull-right" aria-hidden="true"></i></a>
                            </div>  
                            
                        </div>
                     
                </div> 

                 
            </div>
        </div>
            
	</section><!--/form-->

</div>
@endsection