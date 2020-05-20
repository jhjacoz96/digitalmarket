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
                        
                    <form id="registerForm" action="{{url('/comprador/actualizarContraseña/'.auth::user()->id)}}" method="post">
                       
                            @csrf
                        
                         
                        
                         
                            <div class="form-group">
                          
                                <input type="password" name="vieja" id="exampleInputPassword1" placeholder="Ingrese la antigua contraseña">
                              </div>
            
                              <div class="form-group">
                              
                                <input type="password" name="password"  required id="exampleInputPassword1" placeholder="Ingrese la nueva contraseña" autocomplete="new-password">
                                {!!$errors->first('password','<small>:message</small><br>')!!}
                              </div>
            
                              <div class="form-group">
                               
                                <input type="password" name="password_confirmation"  required id="exampleInputPassword1" placeholder="Confirme la nueva contraseña" autocomplete="new-password">
                                
                              </div>
                              
                        
                         
                        
                        
                        <div class="row">
                          
                          <!-- /.col -->
                          <div class="col-md-6">
                            <button type="submit" >Cambiar contreseña</button>
                          </div>
                          
                       
                        </div>
                        
                        
                        
                        </form>
                    
					</div><!--/login form-->
				</div>
			
			</div>
		</div>
	</section><!--/form-->

</div>
@endsection