<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DigitalMarket</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  

    
    @yield('estilos')

    <!-- overlayScrollbars -->

    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>



  </head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed ">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-orange navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
     
      <li class="nav-item d-none d-sm-inline-block">
      <a href="{{route('home')}}" class="nav-link">Home</a>
      </li>
  
    </ul>


     
    <!-- SEARCH FORM -->
    <div id="searchAutoComplete" style="position: relative">
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar producto" name="nombre"  href="{{route('producto.index')}}" v-model="palabraBuscar" v-on:keyup="autoComplete" 
          v-on:keyup.enter="submitForm" 
          aria-label="Search">
          <div class="input-group-append">
            <button id="miBoton" class="btn btn-navbar" ref="submitButtonSearch" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <div class="panel-footer"v-if="resultados.length" style="position: absolute; z-index: 3; left: 9px;"> 

        <ul class="list-group">
          <li class="list-group-item" v-for="resultado in resultados">
            <a class="dropdown-item"
            v-on:click.prevent=" select(resultado)" >
            <span v-html="resultado.nameNegrita">

            </span>
          </a>
          </li>
        </ul>

      </div>

    </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    
      
      <!-- Notifications Dropdown Menu -->
     @if(\Auth::user()->rol_id==2)
       @include('plantilla.header.tienda')
     @endif

      <!--menu-->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-caret-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          <div class="dropdown-divider"></div>
          
          @if (Auth::user()->rol_id=="3")
        <a href="{{route('administrador.show',Auth::user()->id)}}" class="dropdown-item">
              Perfil
            </a>
          @endif

          @if (Auth::user()->rol_id=="2")
        <a href="{{route('administrador.show',Auth::user()->id)}}" class="dropdown-item">
              Perfil
            </a>
          @endif

          <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                {{ __('Salir') }}
            </a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
            </form>
            
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @if(Auth::user()->rol_id=="3")
  @include('plantilla.sider.siderAdministrador')
  @endif

  @if(Auth::user()->rol_id=="2")
  @include('plantilla.sider.siderTienda')
  @endif



  @yield('contenido','default')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<!-- ./wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.2-pre
    </div>
  </footer>

</div>

<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="https://unpkg.com/vue-multiselect@2.1.0"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

<script></script>

<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>

<script src="{{asset('datatable/datatable.js')}}"></script>


<script src="{{ asset('js/appAdmin.js') }}" defer></script>


@yield('scripts')

</body>
</html>


