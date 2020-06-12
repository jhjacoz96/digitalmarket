@extends('layouts.frondTienda.design')
@section('contenido')
<div id="login">
   

    <section id="form" style="margin-top: 20px;"><!--form-->
        
		  <div class="container">

            <div class="p-2">
                @include('flash::message')
            </div>

            <div class="row">
              
                @foreach (\Auth::user()->comprador->direccion as $item)
                <div class="col-sm-4">
        
                        
                    <div class="panel panel-primary mb-3">
                      <div class="panel-heading">
                        <h4>{{$item->nombre}} {{$item->apellido}}</h4>
                      </div>
                      <div class="panel-body " >
                        
                        <p><strong>Estado:</strong> {{$item->zona->parroquia->municipio->estado->nombre}}</p>
                        <p><strong>Municipio:</strong> {{$item->zona->parroquia->municipio->nombre}}</p>
                        <p><strong>Parroquia:</strong> {{$item->zona->parroquia->nombre}}</p>
                        <p><strong>Zona:</strong>{{$item->zona->nombre}}</p>
                        <p><strong>Dirección exacta:</strong> {{$item->direccionExacta}}</p>
                        <p><strong>Punto de referencia:</strong> {{$item->puntoReferencia}}</p>
                        <p><strong>Primer telefono:</strong> {{$item->primerTelefono}}</p>
                        <p><strong>Segundo telefono:</strong>{{$item->segundoTelefono}}</p>
                       
                      </div>
     
                       <div class="panel-footer">
                    
                          <a  href="{{url('/comprador/direccion/'.$item->id.'/edit')}}" class="btn btn-warning btn-sm pull-right"><span class="fa fa-edit" aria-hidden ="true" >Actualizar</span></a>

                          <form action="{{url('/comprador/direccion/'.$item->id)}}" method="POST">
                              @method('DELETE')
                              @csrf
                              <button class="btn btn-danger btn-sm inline-flex " onclick="return confirm('¿Esta seguro que desea eliminar esta dircción?')"><span class="fas fa-trash" aria-hidden ="true" >Eliminar</span></button>
                          </form>

                        </div>  
                     
                     </div>
                   
                </div>
                @endforeach
  
            </div>
        <div class="row">
          <a class="btn btn-primary" href="{{url('/comprador/direccion/create')}}">Agregar dirección</a>
        </div>
      </div>
		</div>
	</section><!--/form-->

</div>
@endsection