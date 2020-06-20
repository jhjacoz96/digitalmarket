<form action="{{route('register')}}" method="post">
    @csrf

 
  <p class="lead">Información de la tienda</p>
  <hr>

  <div class="mb-3">
    <input   name="nombreTienda" 
    type="text" value="{{ old('nombreTienda') }}" class="form-control @error('nombreTienda') is-invalid @enderror" placeholder="Nombre de la tienda"
    >
 
  </div>
  
  @error('nombreTienda')
 <span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
</span>
@enderror


  <div class="mb-3">
    <input id="nombreEncargado"  name="nombreEncargado" 
    type="text" value="{{ old('nombreEncargado') }}" class="form-control @error('nombreEncargado') is-invalid @enderror" placeholder="Nombre del encargado"
    >
  
  </div>
  
  @error('nombreEncargado')
 <span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
</span>
@enderror


<div class=" mb-3">
  <input id="apellidoEncargado"  name="apellidoEncargado" 
  type="text" value="{{ old('apellidoEncargado') }}" class="form-control @error('apellidoEncargado') is-invalid @enderror" placeholder="Apellido del encargado"
  >
 
</div>

@error('apellidoEncargado')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror


  <div class=" mb-3">
    <input id="telefono"  name="telefono" 
    type="text" value="{{ old('telefono') }}" class="form-control @error('telefono') is-invalid @enderror" placeholder="Telefono de contacto"
    >
   
  </div>
  
  @error('telefono')
 <span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
</span>
@enderror


<p class="lead">Información de inicio de sesión</p>
  <hr>



  <div class=" mb-3">
      <input id="email" type="email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"   placeholder="Correo Electronico">
  
  </div>
  
  @error('email')
 <span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
</span>
@enderror

  <div class="mb-3">
       <input id="password" type="password"  class="form-control @error('password') is-invalid @enderror" name="password" required  placeholder="password">
  
  </div>
  
  @error('password')
 <span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
</span>
@enderror

  <div class=" mb-3">
       <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder=" Confirmacion Password">
   
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