@extends('layouts.frondTienda.design')
@section('script')
<script>
    window.data={
    
        editar:'no',
		datos:{
			"totalBs":"{{$totalBs}}",
			"envioFree":"{{$envioFree}}"
		}
      }
</script>
@endsection
@section('contenido')

<div id="checkout">

	@php
		use App\Producto;
		use App\Combinacion;
	@endphp
   
	
    <section id="cart_items" class="mb-4" >
		<div class="container">
			<div class="p-2">
				@include('flash::message')
			</div>
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Inicio</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div>


			

			<a href=""  @click.prevent="aparecerDireccion"><div  class="step-one">
				<h2 class="heading">Dirección de envio</h2>
			
			</div></a>
	

	
			
			<div v-if="abrir1==true"  class="shopper-informations">
		
				<div class="row">	
					<div class="shopper-info" v-if="agregarDireccion==false">
						<div class="row">
						<div class="col-md-6">
							<p>Dirección de entrega</p>
						
							<div class="col-md-6" v-for="direccion in direcciones">
								<div class="panel panel-primary mb-3">

									<div class="panel-heading">
										<div class="form-group">
											<input type="radio" v-model="direccionEnvio" id="direccionEnvio" class="pull-right" :value="direccion.id" name="direccionEnvio">
											<h5>@{{direccion.nombre}} @{{direccion.apellido}}</h5>
											
										</div>
									</div>

									<div class="panel-body" >
									
									@{{direccion.direccionExacta}}<br>
									@{{direccion.puntoReferencia}}<br>
									@{{direccion.primerTelefono}}<br>
								 	 @{{direccion.segundoTelefono}}
								   
									</div>
							
								</div>
							</div>
						
						</div>
					

						<div class="col-md-6">
							<p>Dirección para la factura</p>
						
							<div class="col-md-6" v-for="direccion in direcciones">
							<div class="panel panel-primary mb-3">
								<div class="panel-heading">
									<div class="form-group">
										<input type="radio" v-model="direccionFactura" id="direccionFactura" class="pull-right" :value="direccion.id" name="direccionFactura">
										<h5>@{{direccion.nombre}} @{{direccion.apellido}}</h5>
									</div>
								</div>
								<div class="panel-body">
								   
									@{{direccion.direccionExacta}}<br>
									@{{direccion.puntoReferencia}}<br>
									@{{direccion.primerTelefono}}<br>
								  @{{direccion.segundoTelefono}}
								</div>
							
							</div>
							</div>
						
						</div>
					</div>	
						<div class="form-group my-2">
							<div class="col-sm-12">
	
		
									<button @click.prevent="agregarDireccion=true" class="btn btn-primary float-left" >Agregar nueva dirección</button> 


								</div>
							</div>
					</div>
						
						
					
					

					<div class="col-sm-6 clearfix " v-if="agregarDireccion==true" >
						<div class="bill-to">
							<p>Agregar dirección para la factura</p>
							
								<form action="{{url('/comprador/direccion')}}" method="post">
                       
									@csrf
								<div >
									
									<div class="form-one">
										
										<div class="form-group">

											<input type="text" class="form-control" required="true" name="nombre" id="nombre" placeholder="Nombre" value="{{\Auth::user()->comprador->nombre}}">
											  {!!$errors->first('nombre','<small>:message</small><br>')!!}

										</div>
									
									<div class="form-group">

										<input type="text" class="form-control"  required="true"  class="form-control"  name="apellido"  value="{{\Auth::user()->comprador->apellido}}"  id="apellido" placeholder="Apellido">
										{!!$errors->first('apellido','<small>:message</small><br>')!!}

									</div>

									<div class="form-group">
									<input type="hidden" name="monto" value="{{$totalBs}}">

										<select id="estado_id" class="form-control" v-model='estado_id' @change="getMunicipio()" name="estado_id" >
										  <option value="" selected >Seleccione un estado</option>
										<option :value="estado.id" v-for="(estado, index) in estados" >@{{estado.nombre}}</option>
										</select>
									</div>

									  <div class="form-group">
										<select id="municipio_id" class="form-control"  v-model="municipio_id" @change="getParroquia()" name="municipio_id">
										  <option value="" selected>Seleccione un municipio</option>
										<option :value="municipio.id" v-for="(municipio,index ) in municipios" >@{{municipio.nombre}}</option>
										</select>
									</div>
									<div class="form-group">
										<select id="parroquia_id" class="form-control"  @change="getZona()" v-model="parroquia_id"  name="parroquia_id">
										  <option value="" selected>Seleccione una parroquia</option>
										<option :value="parroquia.id" v-for="(parroquia,index ) in parroquias" >@{{parroquia.nombre}}</option>
										</select>
									</div>
									<div class="form-group">
										<select id="zona_id" class="form-control"  v-model="zona_id" @change="getCodigo()"   name="zona_id">
										  <option value="" selected>Seleccione una zona</option>
										<option :value="zona.id" v-for="(zona,index ) in zonas" >@{{zona.nombre}}</option>
										</select>
									</div>


								   
								</div>
							

								
								<div class="form-two">

									<div class="form-group">

										<input type="text" class="form-control"  readonly name="codigoPostal" v-model="codigoPostal" placeholder="Código postal">
										{!!$errors->first('codigoPortal','<small>:message</small><br>')!!}
									</div>
								
									<div class="form-group">

									<input type="text" class="form-control"  required="true" name="direccion"  placeholder="Dirección exacta">
										{!!$errors->first('direccion','<small>:message</small><br>')!!}
									</div>
										

									<div class="form-group">

										<input type="text" class="form-control"   required="true" name="puntoReferencia"  id=puntoReferencia" placeholder="Punto de referencia">
										{!!$errors->first('puntoReferencia','<small>:message</small><br>')!!}
									</div>
								
									<div class="form-group">

										  <input type="text" class="form-control"    required="true" name="primerTelefono"   placeholder="Primero telefono">
										  {!!$errors->first('primerTelefono','<small>:message</small><br>')!!}
										
									</div>

									<div class="form-group">
									   
										  <input type="text" class="form-control" required="true" name="segundoTelefono"  placeholder="Segundo telefono">
										{!!$errors->first('segundoTelefono','<small>:message</small><br>')!!}
										
									</div>
									   <div class="form-group">

										   <textarea  name="descripcion" class="form-control" rows="3" placeholder="Ingrese una pequeña observación de su a cerca de su dirección"></textarea>
										   {!!$errors->first('observacion','<small>:message</small><br>')!!}
									   </div>

									</div>
									</div>

									<input type="hidden" name="checkout" value="si" >
								<a @click.prevent="agregarDireccion=false" class="btn btn-default">Cancelar</a>
									<button type="submit" class="btn btn-success pull-right">Agregar dirección</button>
									
							</form>
							
							
						</div>
						
					</div>
			</div>
					
				</div>
				
			

			<a href=""  @click.prevent="aparacerMetodoEnvio"><div  class="step-one">
				<h2 class="heading">Método de envio</h2>
			</div></a>


			<div v-if="abrir2==true"  class="shopper-informations">
			
				<div class="shopper-info" >
					<div class="register-req  ">
						<div class="alert" role="alert">
							@{{seleccionEnvio}}
							<div class="row">		
								<div v-for="envio in metodoEnvio" class="col-sm-12">
									<span class="col-sm-3">
										<div>
											<input type="radio" name="envio"  id="envio"
											:value="envio" v-model="selectEnvio">
											
											<label  for="envio">@{{envio.nombre}}</label>
											
										  </div>
									</span>
									
									<span class="col-sm-6">
									<label><strong>Entrega aproximadamente en @{{envio.tiempoEntrega}}</strong></label>
									</span>
									<span class="col-sm-3">
										<label v-if="envio.envioGratis=='A'">Gratis</label>
									<label v-if="envio.envioGratis=='I'">@{{envio.precioEnvio}}</label>
									</span>
								</div>
							</div>
								</div>
							</div>
					</div>
			</div>

			<div class="table-responsive  cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Producto</td>
							<td class="description"></td>
							<td class="price">Precio</td>
							<td class="quantity">Cantidad</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@php
                        $montoTotal=0;
                    @endphp
                    @foreach ($userCarrito as $item)
                        
                    @php
                        $producto=Producto::where('id',$item->producto_id)->first();
                        if($producto->tipoCliente=='combinacion'){
                            $combinacion=Combinacion::where('id',$item->combinacion_id)->first();
                        }
                    @endphp

                        <tr>
                            <td class="cart_product">
                            <a href="">
                                @if($producto->imagen->count()<=0)
                                <img style="width: 100px;"  src="/imagenes/avatar.png" >
                                 @else
                                 <img style="width: 100px;"
                               
                                 src="{{$producto->imagen->random()->url}}" >
                                @endif
                               </a>
                            </td>
                            <td class="cart_description">

                            <h4><a href="">{{$producto->nombre}}</a></h4>
                                @if($producto->tipoCliente=='combinacion')
                               
                                <p>
                                @foreach ($combinacion->atributo as $items)
                                    
                                {{$items->grupoAtributo->nombre}}: {{$items->nombre}} |

                                @endforeach
                            </p>
                                @endif
                            </td>
                            <td class="cart_price">
                            <p>Bs{{$item->precio}}</p>
                            </td>
                            <td class="cart_quantity">
                              {{$item->cantidad}} 
                            </td>
                            <td class="cart_total">
                            <p class="cart_total_price">Bs{{$item->precio*$item->cantidad}}</p>
                            </td>
                        
                        <?php $montoTotal=$montoTotal+($item->precio*$item->cantidad);?>
                    @endforeach

						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>Bs{{$montoTotal}}</</td>
									</tr>
									
									@if(\Auth::user()->comprador->tipoComprador->envioGratis===1)
									<tr class="shipping-cost">
										<td>Costo de envío</td>
										<td>Gratis</td>			
									</tr>
									@else
									<tr class="shipping-cost">
										<td>Costo de envío</td>
										<td>
											Bs@{{selectEnvio.precioEnvio}}
										</td>			
									</tr>
									@endif

									<tr class="shipping-cost">
										<td>Cupón</td>
									<td>
										@if(!empty(\Session::get('montoCupon')))
											Bs{{\Session::get('montoCupon')}}
										@else
											Bs0
										@endif
									</td>			
									<tr class="shipping-cost">
										<td>Descuento adicional</td>
									<td>
										@if(\Session::get('$montoDescuentoTipoComrador')>0)
										
										Bs{{\Session::get('$montoDescuentoTipoComrador')}}
										@else
										Bs0
										@endif
									</td>			
									</tr>
									<tr>
										<td>Monto Total</td>
								
										
									<td><span>Bs@{{precioFijoBs}}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<a href=""  @click.prevent="aparacerMetodoPago"><div  class="step-one">
				<h2 class="heading">Método de pago</h2>
			</div></a>


			<div v-if="abrir3==true"  class="shopper-informations ">
		
				<form name="paymentForm" method="post" id="paymentForm" action="{{url('/realizar-pedido')}}">
					@csrf
					
					<input type="hidden" name="precioFijoBs"  v-model="precioFijoBs">

					<input type="hidden" name="direccionEnvio"  v-model="direccionEnvio">
					<input type="hidden" name="direccionFactura"  v-model="direccionFactura">
					<input type="hidden" name="metodoPagos"  v-model="metodoPagos">
					<input type="hidden" name="metodoEnvio"  v-model="metodoEnvios">

					@php
						
						if(!empty(\Session::get('codigoCupon'))){
							$codigoCupon=\Session::get('codigoCupon');
							$cantidadCupon=\Session::get('montoCupon');
						}
					@endphp
					@if (!empty(\Session::get('codigoCupon')))
						
					<input type="hidden" name="codigoCupon"  value="{{$codigoCupon}}">
					<input type="hidden" name="cantidadCupon"  value="{{$cantidadCupon}}">
					@endif


				<div class="row">		
					<div class="col-sm-12">
					<div class="shopper-info" >

					

							<div class="row">
								<div class="col-sm-12">

									<label for="">Monto restante en bolivares<span> @{{totalBs}}</span></label>
								</div>
								<div class="col-sm-12">
									<label for="">Monto restante en dolares<span> @{{totalDolar}}</span></label>
								</div>
							</div>	
						

					

						<div class="row">

							<div class="form-group col-sm-6" >
								<span>
									En esta sección podrás pagar tu pedido con multiples metodos de pago. Selecciona los metodos de pagos, he indica la cantidad a cancelar con ese método de pago.
									
									Tu pedido estará en espera por transferencia hasta que todos tus pagos sean verificados.
									 
								</span>
							</div>

						</div>

						<div class="row">

							<div class="form-group col-sm-6" >
								<span>
									Monto a pagar BS 
								</span>
							</div>

						</div>

						@{{seletedMetodoPago}}
							

									<div class="tabbable-panel">
										<div class="tabbable-line">
											<ul class="nav nav-tabs ">
												<li class="active">
													<a href="#tab_default_1" data-toggle="tab">
														Transferencia nacionales</a>
												</li>
												<li>
													<a href="#tab_default_2" data-toggle="tab">
														Transferencias internacionales</a>
												</li>
											</ul>
											<div class="tab-content">
												<div class="tab-pane  active" id="tab_default_1">
			
													<div v-for="(pago,index) in arrayNacional"  class="panel panel-default ">
														<div class="panel-body">
			
															<div class="row">
																<div class="col-sm-12">
																	<span>
			
																		<input type="checkbox" 
																		:value="pago"
																		v-model="seletedMetodoPago" >
																		<label for="">@{{pago.nombre}}</label>
																	</span>
																</div>		
															</div>
															<!--<div >
																<div class="form-group">
																<dl class="row">
																	<dt class="col-sm-4">Moneda</dt>
																	<dd class="col-sm-8">Bolivares</dd>
																	<dt class="col-sm-4">Telefono</dt>
																	<dd class="col-sm-8">04266753965</dd>
																	<dt class="col-sm-4">Correo</dt>
																	<dd class="col-sm-8">dede@gmail.com</dd>
																</dl>
																</div>
			
																<div class="form-group">
			
																	<span for="">Banco asociado</span>	
																	</span>
																	<hr>
			
																	<dt class="col-sm-4">Moneda</dt>
																	<dd class="col-sm-8">Bolivares</dd>
																	<dt class="col-sm-4">Telefono</dt>
																	<dd class="col-sm-8">04266753965</dd>
																	<dt class="col-sm-4">Correo</dt>
																	<dd class="col-sm-8">dede@gmail.com</dd>
			
																</div>-->
			
			
			
																<div class="form-group col-sm-6">
																	
																	<span><label class="mx-1" for="">Monto bs</label><input class=" form-control float-right"  v-model.numer="pago.cantidad" type="text"></span>
																	
																</div>
															</div>
														</div>
													</div>
			
													<div class="tab-pane" id="tab_default_2">
					
														
														<div v-for="(pago,index) in arrayInternacional"  class="panel panel-default ">
															<div class="panel-body">
				
																<div class="row">
																	<div class="col-sm-12">
																		<span>
				
																			<input type="checkbox"
																			:value="pago"
																			v-model.numer="seletedMetodoPago" >
																			<label for="">@{{pago.nombre}}</label>
																		</span>
																	</div>		
																</div>
																<!--<div >
																	<div class="form-group">
																	<dl class="row">
																		<dt class="col-sm-4">Moneda</dt>
																		<dd class="col-sm-8">Bolivares</dd>
																		<dt class="col-sm-4">Telefono</dt>
																		<dd class="col-sm-8">04266753965</dd>
																		<dt class="col-sm-4">Correo</dt>
																		<dd class="col-sm-8">dede@gmail.com</dd>
																	</dl>
																	</div>
				
																	<div class="form-group">
				
																		<span for="">Banco asociado</span>	
																		</span>
																		<hr>
				
																		<dt class="col-sm-4">Moneda</dt>
																		<dd class="col-sm-8">Bolivares</dd>
																		<dt class="col-sm-4">Telefono</dt>
																		<dd class="col-sm-8">04266753965</dd>
																		<dt class="col-sm-4">Correo</dt>
																		<dd class="col-sm-8">dede@gmail.com</dd>
			
																	</div>-->
				
				
				
			
																	<div class="form-group col-sm-6">
																		<span><label class="mx-1" for="">Monto $</label><input class=" form-control float-right"  v-model.numer="pago.cantidad" type="text"></span>
																	</div>
																</div>
															</div>
															
				
													</div>
			
			
											</div>
										</div>
									</div>
								 
								


							

							
						</div>
					</div>
					<div class="col-sm-12">

						<button type="submit" :disabled="totalBs!=0"  class="btn btn-primary">Confirmar pago</button>
						
						<button @click.prevent="calcularRestante()" class="btn btn-secondary">Calcular restante</button>
					</div>
				</div>							
			</form>
			</div>
	
		</div>
	</section > <!--/#cart_items-->


</div>

@endsection