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
        
                <a href="{{url('/comprador/perfil/'.\auth::user()->id)}}">
                        <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
           
                         <div class="card-body " style="background-color: silver;">
                           <h5 class="card-title">perfil</h5>
                         <div>
         
                             <i class="fa fa-user" ></i>
                         </div>
                         </div>
                       </div>
                    </a> 
                    </div>

                 

                    <div class="col-sm-4">
        
                        <a href="{{url('/comprador/direcciones/'.\auth::user()->id)}}">
                        <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
            
                            <div class="card-body " style="background-color: silver;">
                            <h5 class="card-title">Mis direcciones</h5>
                            <div>
            
                                <i class="fa fa-user" ></i>
                            </div>
                            </div>
                        </div>
                    </a>
                    </div>
            </div>
			</div>
		</div>
	</section><!--/form-->

</div>
@endsection