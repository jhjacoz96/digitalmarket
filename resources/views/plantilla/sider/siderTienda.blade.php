<aside class="main-sidebar sidebar-light-orange  elevation-4">
    <!-- Brand Logo -->
<a href="{{url('/home')}}" class="brand-link">
<img src="{{asset('/imagenes/logo/logo.png')}}"
           alt="AdminLTE Logo"
           class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-dark">DigitalMarket</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar ">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
  
        <div class="info">
        <a class="d-block">Tienda {{\Auth::user()->tienda->nombreTienda}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar  flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
               <li class="nav-item ">
                <a href="{{route('tiendas.pedido.consultar')}}" class="nav-link " >
                    <i class="nav-icon fas fa-box-open"></i>
                    <p>
                       Pedidos solicitados
                    </p>
                  </a>
                </li>

               <li class="nav-item">
               <a href="{{route('tiendas.producto.index')}}" class="nav-link">
                   <i class="fas fa-shopping-basket"></i>
                   <p>
                     Productos 
                   </p>
                 </a>
               </li>

               <li class="nav-item">
               <a href="{{route('tiendas.grupoAtributo.index')}}" class="nav-link">
                   <i class="nav-icon fas fa-object-group"></i>
                   <p>
                     Grupos de atributos
                   </p>
                 </a>
               </li>

               <li class="nav-item">
               <a href="{{route('tiendas.producto.masivo')}}" class="nav-link">
                   <i class="nav-icon fas fa-file-excel"></i>
                   <p>
                     Agregar productos en masa
                   </p>
                 </a>
               </li>

               

         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  