@extends('layouts.frondTienda.design')
@section('script')
<script>
    window.data={
      
        editar:'no'
            
      }
</script>
@endsection

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
                        <h2>Nueva dirección</h2>
                        
                    <form id="registerForm" action="{{url('/comprador/direccion')}}" method="post">
                       
                            @csrf
                        
                          <div class="form-one">

                            <div class="form-group">
                             
                            <input type="text" required="true" name="nombre" id="nombre" placeholder="Nombre" value="{{\Auth::user()->comprador->nombre}}">
                              {!!$errors->first('nombre','<small>:message</small><br>')!!}
                            </div>
          
                            <div class="form-group">
                              
                              <input type="text" required="true" name="apellido"  value="{{\Auth::user()->comprador->apellido}}"  id="apellido" placeholder="Apellido">
                              {!!$errors->first('apellido','<small>:message</small><br>')!!}
                            </div>
          
                            <div class="form-group">
                              
                              <select id="estado_id" v-model='estado_id' @change="getMunicipio()" name="estado_id" >
                                <option value="" selected >Seleccione un estado</option>
                              <option :value="estado.id" v-for="(estado, index) in estados" >@{{estado.nombre}}</option>
                              </select>
                            </div>
                            
                            <div class="form-group">
                              
                              <select id="municipio_id" v-model="municipio_id" @change="getParroquia()" name="municipio_id">
                                <option value="" selected>Seleccione un municipio</option>
                              <option :value="municipio.id" v-for="(municipio,index ) in municipios" >@{{municipio.nombre}}</option>
                              </select>
                            </div>
          
                            <div class="form-group">
                              
                              <select id="parroquia_id" @change="getZona()" v-model="parroquia_id"  name="parroquia_id">
                                <option value="" selected>Seleccione una parroquia</option>
                              <option :value="parroquia.id" v-for="(parroquia,index ) in parroquias" >@{{parroquia.nombre}}</option>
                              </select>
                            </div>
          
                            <div class="form-group">
                              
                              <select id="zona_id" v-model="zona_id" @change="getCodigo()"   name="zona_id">
                                <option value="" selected>Seleccione una zona</option>
                              <option :value="zona.id" v-for="(zona,index ) in zonas" >@{{zona.nombre}}</option>
                              </select>
                            </div>
                         
                  
                            <div class="form-group">
                              
                              <input type="text" readonly required="true" name="codigoPostal" v-model="codigoPostal" placeholder="Código postal">
                              {!!$errors->first('codigoPortal','<small>:message</small><br>')!!}
                            </div>
                          </div>
              
                          <div class="form-two">

                            <div class="form-group">
                            
                              <input type="text" required="true" name="direccion"  id="direccion" placeholder="Dirección exacta">
                              {!!$errors->first('direccion','<small>:message</small><br>')!!}
                            </div>
          
                            <div class="form-group">
                              
                              <input type="text" required="true" name="puntoReferencia"  id=puntoReferencia" placeholder="Punto de referencia">
                              {!!$errors->first('puntoReferencia','<small>:message</small><br>')!!}
                            </div>
          
                            
          
                               
            
                              <div class="form-group">
                               
                                <input type="text" required="true" name="primerTelefono"   placeholder="Primero telefono">
                                {!!$errors->first('primerTelefono','<small>:message</small><br>')!!}
                              </div>
                              <!-- /.input group -->
                          
                          
                             
                              <div class="form-group">
                                
                                <input type="text" required="true" name="segundoTelefono"  placeholder="Segundo telefono">
                              {!!$errors->first('segundoTelefono','<small>:message</small><br>')!!}
                              </div>
                              <!-- /.input group -->
                            
                            <div class="form-group">
                             
                              <textarea  name="descripcion" id="descripcion" rows="3" placeholder="Ingrese una pequeña observación de su a cerca de su dirección"></textarea>
                              {!!$errors->first('observacion','<small>:message</small><br>')!!}
                            </div>
                          </div>
            
                           
                        
                    
                         
                        
                        
                            <div class="row">
                          
                                <!-- /.col -->
                                <div class="col-md-12">
                                  <button type="submit" >Agregar dirección</button>
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