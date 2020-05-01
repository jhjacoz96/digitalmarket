@include('template.headAuth')

<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="http://localhost/digitalmarket/public/adminlte/index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

    <form action="{{route('registerTienda')}}" method="post">
      @csrf
        <div class="form-group mb-3">
          <input id="nombre" name="nombre" 
          type="text" value="{{ old('nombre') }}" class="form-control" @error('nombre') is-invalid @enderror" placeholder="Nombre"
          required autocomplete="nombre">    
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('nombre')
         <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>

        <div class="form-group mb-3">
          <input id="apellido" name="apellido" type="text" class="form-control" @error('apellido') is-invalid @enderror" placeholder="Apellido"
          value="{{ old('apellido') }}"
          required autocomplete="apellido"> 
          
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('apellido')
         <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>

        <div class="form-group mb-3">
          <input id="email" type="email" class="form-control" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required  placeholder="Correo Electronico">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
         <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>

        <div class="form-group mb-3">
          <input id="rif" type="text" class="form-control" @error('rif') is-invalid @enderror" name="rif" value="{{ old('rif') }}" required  placeholder="Rif">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('rif')
         <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>

        <div class="form-group mb-3">
          <input id="telefono" type="text" class="form-control" @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required  placeholder="Telefono">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('telefono')
         <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>

        <div class="form-group mb-3">
          <input id="direccion" type="text" class="form-control" @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" required  placeholder="Dirección">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('direccion')
         <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>

        <div class="form-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required  placeholder="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
         <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>

        <div class="form-group mb-3">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder=" Confirmacion Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
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
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
<!--
      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>
    -->
      <a href="login.html" class="text-center">Ya estoy registrado</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

@include('template.scrAuth')
