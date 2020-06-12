@extends('layouts.frondTienda.design')
@section('contenido')
<div id="login">
   

    <section id="form" style="margin-top: 20px;"><!--form-->
        
		<div class="container">
            <div class="p-2">
                @include('flash::message')
             </div>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
                        <h2>Mi perfil</h2>
                        
                    <form id="registerForm" action="{{url('/comprador/perfil/'.\auth::user()->id)}}" method="post">
                        @method('PUT')
                            @csrf
                        
                            <p class="lead">Información personal</p>
                          <hr>
                        
                          
                           <div class=" mb-3">
                             <input id="nombre"  name="nombre" 
                           type="text" value="{{$comprador->nombre}}" class=" form-control @error('nombre') is-invalid @enderror" placeholder="Nombre"
                             >
                            
                           </div>
                           
                           @error('nombre')
                          <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                        
                           <div class=" mb-3">
                             <input id="apellido"  name="apellido" 
                             type="text" value="{{$comprador->apellido}}"   class=" form-control @error('apellido') is-invalid @enderror" placeholder="Apellido"
                             >
                           
                           </div>
                           
                           @error('apellido')
                          <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                        
                        
                         <p class="lead">Información de inicio de sesión</p>
                          <hr>
                        
                           <div class=" mb-3">
                               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$comprador->correo}}"placeholder="Correo Electronico">
                            
                           </div>
                           
                           @error('email')
                          <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                        
                    
                         
                        
                        
                        <div class="row">
                          
                          <!-- /.col -->
                          <div class="col-sm-12 ">
                            <button type="submit" class="btn btn-primary btn-sm pull-right" >Actualizar perfil</button>

                            <a  href="{{url('/comprador/perfil/'.\Auth::user()->id.'/edit')}}" >Cambiar contraseña</a>
                          </div>
                          
                          
                      
                 
                        
                        
                        
                        </form>
                    
					</div><!--/login form-->
				</div>
			
			</div>
		</div>
	</section><!--/form-->

</div>
@endsection