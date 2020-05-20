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
        
                        
                    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
       
                     <div class="card-body " style="background-color: silver;">
                        {{$item->nombre}} {{$item->apellido}}
                        {{$item->zona->parroquia->municipio->estado->nombre}} | {{$item->zona->parroquia->municipio->nombre}} | {{$item->zona->parroquia->nombre}} | {{$item->zona->nombre}}
                        {{$item->direccionExacta}}
                        {{$item->puntoReferencia}}
                        {{$item->primerTelefono}}
                       {{$item->segundoTelefono}}
                       
                     <div>
     
                       <div class="card-footer">
                          
                        <form action="{{url('/comprador/direccion/'.$item->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-default btn-sm d-inline float-left" onclick="return confirm('¿Esta seguro que desea eliminar esta dircción?')">Eliminar</button>
                          </form>
                       <a href="{{url('/comprador/direccion/'.$item->id.'/edit')}}">Modificar</span></a>
                        </div>  
                     </div>
                     </div>
                   </div>
                </div>
                @endforeach
          

            </div>
        <a href="{{url('/comprador/direccion/create')}}">Agregar dirección</a>
			</div>
		</div>
	</section><!--/form-->

</div>
@endsection