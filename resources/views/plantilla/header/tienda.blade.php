
@section('scripts')
<script>
    function markNotificationAsRead($parametro){
	
     $.get(`/t/${$parametro}`)
     
     }
</script>
@endsection
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-bell"></i>
      @if(count(\Auth::user()->tienda->unreadNotifications))
      <span class="badge badge-info navbar-badge">{{count(\Auth::user()->tienda->unreadNotifications)}}</span>
      @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-item dropdown-header">{{count(\Auth::user()->tienda->unreadNotifications)}} notificationes</span>

      @foreach (\Auth::user()->tienda->unreadNotifications as $notificacion)
        <div class="dropdown-divider"></div>
        @if($notificacion->data["estado"]=='pagoRealizado')
    <a href="{{url('/tiendas/pedido/detalle/'.$notificacion['data']['pedido'])}}" onclick="markNotificationAsRead('{{$notificacion->id}}')" class="dropdown-item">
          <i class="fas fa-shopping-bag mr-2"></i> Pago de pedido-{{$notificacion['data']['pedido']}}
          <span class="float-right text-muted text-sm">{{$notificacion->created_at->diffForHumans()}}</span>
        </a>
        @endif
        @if($notificacion->data["estado"]=='productoStock')
        <a href="{{url('/tiendas/producto/'.$notificacion['data']['pedido'].'/edit')}}" onclick="markNotificationAsRead('{{$notificacion->id}}')" class="dropdown-item">
          <i class="fas fa-shopping-bag mr-2"></i> Stock mínimo de producto
          <span class="float-right text-muted text-sm">{{$notificacion->created_at->diffForHumans()}}</span>
      </a>
        @else
        <a href="{{url('/tiendas/pedido/detalle/'.$notificacion['data']['pedido'])}}" onclick="markNotificationAsRead('{{$notificacion->id}}')" class="dropdown-item">
            <i class="fas fa-shopping-bag mr-2"></i> Nuevo pedido-{{$notificacion['data']['pedido']}}
            <span class="float-right text-muted text-sm">{{$notificacion->created_at->diffForHumans()}}</span>
        </a>
        @endif
      @endforeach

      
      
      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item dropdown-footer">Marcar todos como leidos</a>
    </div>
  </li>