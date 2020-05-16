<form action="{{route('register')}}" method="post">
    @csrf

    <p class="lead">Información personal</p>
  <hr>

  
   <div class="input-group mb-3">
     <input id="nombre"  name="nombre" 
     type="text" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre"
     >
     <div class="input-group-append">
       <div class="input-group-text">
         <span class="fas fa-user"></span>
       </div>
     </div>
   </div>
   
   @error('nombre')
  <span class="invalid-feedback" role="alert">
   <strong>{{ $message }}</strong>
 </span>
 @enderror

   <div class="input-group mb-3">
     <input id="apellido" v-model="apellido"  name="apellido" 
     type="text" value="{{ old('apellido') }}" class="form-control @error('apellido') is-invalid @enderror" placeholder="Apellido"
     >
     <div class="input-group-append">
       <div class="input-group-text">
         <span class="fas fa-user"></span>
       </div>
     </div>
   </div>
   
   @error('apellido')
  <span class="invalid-feedback" role="alert">
   <strong>{{ $message }}</strong>
 </span>
 @enderror


 <p class="lead">Información de inicio de sesión</p>
  <hr>

   <div class="input-group mb-3">
       <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Correo Electronico">
     <div class="input-group-append">
       <div class="input-group-text">
         <span class="fas fa-envelope"></span>
       </div>
     </div>
   </div>
   
   @error('email')
  <span class="invalid-feedback" role="alert">
   <strong>{{ $message }}</strong>
 </span>
 @enderror

   <div class="input-group mb-3">
        <input id="password"  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required  placeholder="password">
     <div class="input-group-append">
       <div class="input-group-text">
         <span class="fas fa-lock"></span>
       </div>
     </div>
   </div>
   
   @error('password')
  <span class="invalid-feedback" role="alert">
   <strong>{{ $message }}</strong>
 </span>
 @enderror

   <div class="input-group mb-3">
        <input id="password-confirm"  type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder=" Confirmacion Password">
     <div class="input-group-append">
       <div class="input-group-text">
         <span class="fas fa-lock"></span>
       </div>
     </div>
   </div>
   
   @error('password_confirmation')
  <span class="invalid-feedback" role="alert">
   <strong>{{ $message }}</strong>
 </span>
 @enderror

 <input type="hidden" v-model="rol_id" name="rol_id">


<div class="row">
  <div class="col-8">
    <div class="icheck-primary">
      <input type="checkbox" id="agreeTerms" name="terms" value="agree">
      <label for="agreeTerms">
       I agree to the <a href="#">terms</a>
      </label>
    </div>
  </div>
  <!-- /.col -->
  <div class="col-md-4">
    <button type="submit" class="btn btn-primary btn-block">Registar</button>
  </div>
  <!-- /.col -->
</div>

<a href="{{route('login')}}" class="text-center">Ya estoy registrado</a>

</form>