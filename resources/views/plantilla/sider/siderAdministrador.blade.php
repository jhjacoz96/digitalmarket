<aside class="main-sidebar sidebar-light-orange elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/home')}}" class="brand-link">
      <img src="{{asset('/imagenes/logo/logo.png')}}"
                 alt="AdminLTE Logo"
                 class="brand-image "
                 style="opacity: .8">
            <span class="brand-text font-weight-dark">DigitalMarket</span>
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
         



               <li class="nav-header">Pedidos</li>
               <li  class="nav-item has-treeview ">
                <a href="#" class="nav-link ">
                
                  <i class="fas fa-box-open"></i>
                  <p>
                    Administrar pedidos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <a href="{{route('pedido.consultar','esperaTransferencia')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Espera por pago</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('pedido.consultar','pagoAceptado')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pago aceptado</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('pedido.consultar','preparandoPedido')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Preparando pedido</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('pedido.consultar','enviadoComprador')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Enviado al comprador</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('pedido.consultar','culminado')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Culminado</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('pedido.consultar','cancelado')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Cancelado</p>
                    </a>
                  </li>
                </ul>
              </li>




               <li class="nav-header">Tienda</li>
          <li  class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
            
              <i class="fas fa-store"></i>
              <p>
                Adminisrar tiendas
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
              <li class="nav-item">
                <a href="{{url('/pagos-tiendas')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pago de pedidos</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Venta</li>
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
              <i class="fas fa-book-open"></i>
              <p>
                Administrar catálago
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('producto.index')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('categoria.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categorias</p>
                </a>
              </li>
           
              <li class="nav-item">
                <a href="{{route('marca.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marcas</p>
                </a>
              </li>
            
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="fas fa-users"></i>
              <p>
                Administrar compradores
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
                <a href="{{route('tipoComprador.index')}}" class="nav-link ">
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
               Administrar Envío
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('metodoEnvio.index')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Medios de envio</p>
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
               Administrar medios pago
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('metodoPago.index')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Medios de pago</p>
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

  