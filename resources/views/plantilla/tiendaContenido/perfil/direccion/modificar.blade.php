@extends('layouts.frondTienda.design')
@section('script')
<script>
    window.data={
      
        editar:'si',
        datos:{
          "estado_id":"{{$direccion->zona->parroquia->municipio->estado->id}}",
          "municipio_id":"{{$direccion->zona->parroquia->municipio->id}}",
          "parroquia_id":"{{$direccion->zona->parroquia->id}}",
          "zona_id":"{{$direccion->zona->id}}",
          "codigoPostal":"{{$direccion->zona->codigoPostal}}",
        }
            
    
      }
</script>

@section('contenido')
<div id="direccion">
   

    <section id="form" style="margin-top: 20px;"><!--form-->
        
		<div class="container">
            <div class="p-2">
                @include('flash::message')
             </div>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form">
                        <h2>Actualizar direccion</h2>
                        
                    <form id="registerForm" action="{{url('/comprador/direccion/'.$direccion->id)}}" method="post">
                       @method('PUT')
                            @csrf
                        
                        
                            <div >
                               
                                <input type="text" required="true" name="nombre" id="nombre" placeholder="Nombre" value="{{$direccion->nombre}}">
                                  {!!$errors->first('nombre','<small>:message</small><br>')!!}
                                </div>
              
                                <div >
                                  
                                  <input type="text" required="true" name="apellido"  value="{{$direccion->apellido}}"  id="apellido" placeholder="Apellido">
                                  {!!$errors->first('apellido','<small>:message</small><br>')!!}
                                </div>
              
                                <div >
                                  
                                  <select id="estado_id" v-model='estado_id' @change="getMunicipio()" name="estado_id" >
                                    <option value="" selected >Seleccione un estado</option>
                                  <option :value="estado.id" v-for="(estado, index) in estados" >@{{estado.nombre}}</option>
                                  </select>
                                </div>
                                
                                <div>
                                  
                                  <select id="municipio_id" v-model="municipio_id" @change="getParroquia()" name="municipio_id">
                                    <option value="" selected>Seleccione un municipio</option>
                                  <option :value="municipio.id" v-for="(municipio,index ) in municipios" >@{{municipio.nombre}}</option>
                                  </select>
                                </div>
              
                                <div >
                                  
                                  <select id="parroquia_id" @change="getZona()" v-model="parroquia_id"  name="parroquia_id">
                                    <option value="" selected>Seleccione una parroquia</option>
                                  <option :value="parroquia.id" v-for="(parroquia,index ) in parroquias" >@{{parroquia.nombre}}</option>
                                  </select>
                                </div>
              
                                <div >
                                  
                                  <select id="zona_id" v-model="zona_id" @change="getCodigo()"   name="zona_id">
                                    <option value="" selected>Seleccione una zona</option>
                                  <option :value="zona.id" v-for="(zona,index ) in zonas" >@{{zona.nombre}}</option>
                                  </select>
                                </div>
                             
                      
                                <div >
                                  
                                  <input type="text" readonly required="true" name="codigoPostal" v-model="codigoPostal" placeholder="Código postal">
                                  {!!$errors->first('codigoPortal','<small>:message</small><br>')!!}
                                </div>
              
                                <div >
                                
                                  <input type="text" required="true" name="direccion" value="{{$direccion->direccionExacta}}"  id="direccion" placeholder="Dirección exacta">
                                  {!!$errors->first('direccion','<small>:message</small><br>')!!}
                                </div>
              
                                <div >
                                  
                                  <input type="text" required="true" name="puntoReferencia" value="{{$direccion->puntoReferencia}}"  id="puntoReferencia" placeholder="Punto de referencia">
                                  {!!$errors->first('puntoReferencia','<small>:message</small><br>')!!}
                                </div>
              
                                
              
                                   
                
                                  <div >
                                   
                                    <input type="text" required="true" name="primerTelefono"  value="{{$direccion->primerTelefono}}" placeholder="Primero telefono">
                                    {!!$errors->first('primerTelefono','<small>:message</small><br>')!!}
                                  </div>
                                  <!-- /.input group -->
                              
                              
                                 
                                  <div >
                                    
                                    <input type="text" required="true" name="segundoTelefono" value="{{$direccion->segundoTelefono}}"  placeholder="Segundo telefono">
                                  {!!$errors->first('segundoTelefono','<small>:message</small><br>')!!}
                                  </div>
                                  <!-- /.input group -->
                                
                                <div >
                                 
                                  <textarea  name="descripcion" id="descripcion" rows="3" placeholder="Ingrese una pequeña observación de su a cerca de su dirección">{!!$direccion->observacion!!}</textarea>
                                  {!!$errors->first('observacion','<small>:message</small><br>')!!}
                                </div>
                           
                        
                    
                         
                        
                        
                            <div class="row">
                          
                                <!-- /.col -->
                                <div class="col-md-6">
                                  <button type="submit" >Actualizar dirección</button>
                                </div>
                                
                             
                              </div>
                          
                        
                        
                        
                        </form>
                    
					</div><!--/login form-->
				</div>
			
			</div>
		</div>
	</section><!--/form-->

</div>
@endsection