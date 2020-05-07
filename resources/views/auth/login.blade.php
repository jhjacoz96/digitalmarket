@include('template.headAuth')

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <a href="{{url('/')}}"><b>Digital</b>Market</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Iniciar sesión</p>

      <form action="{{ route('login') }}" method="post">
        @csrf
       
        <div class="input-group mb-3">
          <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required   autofocus placeholder="Correo Electrónico">
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
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required  placeholder="Contraseña">
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
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-success btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        

        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('¿Ha olvidado su contraseña?') }}
            </a>
        @endif

      </p>
      <p class="mb-0">
      Si aún no se ha registrado, puede hacerlo como <a href="register.html" class="text-center">tienda</a> o como <a href="{{route('register')}}" class="text-center">comprador</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</body>
@include('template.scrAuth')