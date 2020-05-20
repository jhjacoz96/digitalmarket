<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://localhost/digitalmarket/public/adminlte/index3.html" class="brand-link">
      <img src="http://localhost/digitalmarket/public/adminlte/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
  
        <div class="info">
          <a class="d-block">Tienda</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
               <li class="nav-item">
               <a href="{{route('tiendas.producto.index')}}" class="nav-link">
                   <i class="nav-icon fas fa-users"></i>
                   <p>
                     Consultar productos 
                   </p>
                 </a>
               </li>

               <li class="nav-item">
               <a href="{{route('tiendas.grupoAtributo.index')}}" class="nav-link">
                   <i class="nav-icon fas fa-users"></i>
                   <p>
                     Mis grupos de atributos
                   </p>
                 </a>
               </li>

         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  