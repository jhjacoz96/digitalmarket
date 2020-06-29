<form id="registerForm" action="{{url('/registrar-usuario')}}" method="post">
    @csrf

    <p class="lead">Información personal</p>
  <hr>

  
   <div class=" mb-3">
     <input id="nombre"  name="nombre" 
     type="text" value="{{ old('nombre') }}" class=" form-control @error('nombre') is-invalid @enderror" placeholder="Nombre"
     >
    
   </div>
   
   @error('nombre')
  <span class="invalid-feedback" role="alert">
   <strong>{{ $message }}</strong>
 </span>
 @enderror

   <div class=" mb-3">
     <input id="apellido"  name="apellido" 
     type="text" value="{{ old('apellido') }}"   class=" form-control @error('apellido') is-invalid @enderror" placeholder="Apellido"
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
       <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Correo Electronico">
    
   </div>
   
   @error('email')
  <span class="invalid-feedback" role="alert">
   <strong>{{ $message }}</strong>
 </span>
 @enderror

   <div class=" mb-3">
        <input id="password"  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required  placeholder="Contraseña">
   
   </div>
   
   @error('password')
  <span class="invalid-feedback" role="alert">
   <strong>{{ $message }}</strong>
 </span>
 @enderror

   <div class=" mb-3">
        <input id="password-confirm"  type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder=" Confirmar contraseña">
    
   </div>
   
   @error('password_confirmation')
  <span class="invalid-feedback" role="alert">
   <strong>{{ $message }}</strong>
 </span>
 @enderror

 <input type="hidden" v-model="rol_id" name="rol_id">


 <div class="row">
  <div class="col-md-12">
    <a href="{{url('/iniciar-sesion')}}" class="text-center">Ya estoy registrado</a>
  </div>
  <div class="col-md-12">
    <button type="submit" class=" btn-block">Registrar</button>
  </div>

  
 
</div>



</form>