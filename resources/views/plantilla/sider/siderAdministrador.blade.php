<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
      <span class="brand-text font-weight-light">DigitalMarcket</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
  
        <div class="info">
          <a class="d-block">Administrador</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         



          <li  class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
            
              <i class="fas fa-store"></i>
              <p>
                Tiendas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('tienda.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tiendas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('Plan.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Planes de afiliación</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Venta</li>
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
              <i class="fas fa-book-open"></i>
              <p>
                Catalago
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('producto.index')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Producto</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('categoria.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categoria</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('grupoAtributo.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Atributos</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="fas fa-users"></i>
              <p>
                Compradores
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('Comprador.index')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compradores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=""{{route('tipoComprador.index')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tipos de compradores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('direccion.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Direcciones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('cupon.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cupón de descuento</p>
                </a>
              </li>
            </ul>
          </li>

          


          <li class="nav-header">Checkout</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="fas fa-shipping-fast"></i>
              <p>
               Envio
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('metodoEnvio.index')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Metodo envio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('filtroDireccion.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Filtros de dirección</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
              <i class="fas fa-money-check-alt"></i>
              <p>
               Pago
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('metodoPago.index')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Metodo pago</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('bancoMetodoPago.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bancos</p>
                </a>
              </li>
            </ul>
          </li>

          
          


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  