<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Blank Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

  <!-- overlayScrollbars -->

  <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

  <script src="{{ asset('js/appAdmin.js') }}" defer></script>

</head>

<body class="hold-transition register-page">
  <div id="login">
   
<div class="register-box">
  <div class="register-logo">
    <a href="http://localhost/digitalmarket/public/adminlte/index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-header ">
     
      <ul class="nav nav-pills ml-auto p-2">
        <li class="nav-item"><a class="nav-link active" @click="rol_id=1"  href="#comprador" data-toggle="tab">Comprador</a></li>
        <li class="nav-item"><a class="nav-link" @click="rol_id=2" href="#tienda" data-toggle="tab">Tienda</a></li>
      </ul>
    </div>
    <div  class="card-body register-card-body ">
      

    

     <div class="tab-content">
       <div class="tab-pane active" id="comprador">
         
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
             <input id="email" type="email" v-model="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Correo Electronico">
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
              <input id="password" v-model="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required  placeholder="password">
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
              <input id="password-confirm" v-model="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder=" Confirmacion Password">
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


      </div>

      <div class="tab-pane" id="tienda">
        <form action="{{route('register')}}" method="post">
          @csrf

       
        <p class="lead">Información de la tienda</p>
        <hr>

        <div class="input-group mb-3">
          <input   name="nombreTienda" 
          type="text" value="{{ old('nombreTienda') }}" class="form-control @error('nombreTienda') is-invalid @enderror" placeholder="Nombre de la tienda"
          >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        
        @error('nombreTienda')
       <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror


        <div class="input-group mb-3">
          <input id="nombreEncargado"  name="nombreEncargado" 
          type="text" value="{{ old('nombreEncargado') }}" class="form-control @error('nombreEncargado') is-invalid @enderror" placeholder="Nombre del encargado"
          >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        
        @error('nombreEncargado')
       <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror


      <div class="input-group mb-3">
        <input id="apellidoEncargado"  name="apellidoEncargado" 
        type="text" value="{{ old('apellidoEncargado') }}" class="form-control @error('apellidoEncargado') is-invalid @enderror" placeholder="Apellido del encargado"
        >
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
      </div>
      
      @error('apellidoEncargado')
     <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror


        <div class="input-group mb-3">
          <input id="telefono"  name="telefono" 
          type="text" value="{{ old('telefono') }}" class="form-control @error('telefono') is-invalid @enderror" placeholder="Telefono de contacto"
          >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        
        @error('telefono')
       <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror

      
      <p class="lead">Información de inicio de sesión</p>
        <hr>


  
        <div class="input-group mb-3">
            <input id="email" type="email" v-model="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"   placeholder="Correo Electronico">
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
             <input id="password" type="password" v-model="password" class="form-control @error('password') is-invalid @enderror" name="password" required  placeholder="password">
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
             <input id="password-confirm" v-model="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder=" Confirmacion Password">
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
        <div class="col-md-8">
          <div class="icheck-primary">
            <input type="checkbox"  value="agree">
            <label for="agreeTerms">
             I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
        <!-- /.col -->
      </div>
  
      <a href="{{route('login')}}" class="text-center">Ya estoy registrado</a>

    </form>

      </div>
      


    </div>
        
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

</div>

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>

<script src="https://unpkg.com/vue-multiselect@2.1.0"></script>


</body>
</html>