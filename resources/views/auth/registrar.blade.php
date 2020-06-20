@extends('layouts.frondTienda.design')
@section('contenido')
<div id="login">
  <section id="form " style="margin-top:20px; ">
    <!--form-->
    <div class="container">
      <div class="row">
        <div class="col-sm-4 col-sm-offset-1">
          <div class="signup-form">
            <!--sign up form-->


            <div class="panel">
              <div class="panel-header ">

                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" @click="rol_id=1" href="#comprador"
                      data-toggle="tab">Comprador</a></li>
                  <li class="nav-item"><a class="nav-link" @click="rol_id=2" href="#tienda" data-toggle="tab">Tienda</a>
                  </li>
                </ul>
              </div>
              <div class="panel-body register-panel-body ">

                <div class="tab-content">

                  <div class="tab-pane active" id="comprador">

                    <div v-if="rol_id==1">
                      @include('auth.tipoRegister.comprador')
                    </div>

                  </div>

                  <div class="tab-pane" id="tienda">


                    <div v-if="rol_id==2">
                      @include('auth.tipoRegister.tienda')
                    </div>


                  </div>

                </div>



              </div>
              <!-- /.form-box -->
            </div><!-- /.card -->


          </div>
          <!--/sign up form-->
        </div>

      </div>
    </div>
  </section>
  <!--/form-->

</div>
@endsection