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
      
       <div class="tab-pane active"  id="comprador">
      
        <div v-if="rol_id==1">
          @include('auth.tipoRegister.comprador')
        </div>

       


      </div>

      <div class="tab-pane"  id="tienda">

      
          <div v-if="rol_id==2">

            @include('auth.tipoRegister.tienda')
          </div>
    

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

<script src="{{ asset('js/appAdmin.js') }}" defer></script>


</body>
</html>