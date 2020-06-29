@extends('layouts.appAdmin')

@section('contenido')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Perfil</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          
          <li class="breadcrumb-item active">Perfil</li>
          </ol>

      </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Mi perfil</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="" method="post" id="quickForm">
                
                @csrf
                
                <div class="p-2">
                  @include('flash::message')
               </div>


               <div class="box-profile">
                <div class="text-center">
                  <img style="border-radius: 50%;" class="profile-user-img img-fluid img-circle"
                        @if(!empty($tienda->imagen->url))
                        src="{{$tienda->imagen->url}}"
                        @else
                        src="{{asset('/imagenes/tienda/tienda.png')}}"
                        @endif

                       alt="User profile picture">
                </div>
                      
                
                <h3 class="profile-username text-center">{{$tienda->nombreTienda}}</h3>
                
                <p class="text-muted text-center">Plan de afiliacion {{$tienda->planAfiliacion->nombre}}</p>
                <div style="align-items: center; justify-content: center; display: flex;">
                <a href="{{url('/tiendas/ver-cuenta')}}" class="btn btn-success" ><i class="fas fa-hand-holding-usd"></i></a>
                </div>
               </div>

                

                  @yield('contenidoo')

                  


              </form>
              
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection