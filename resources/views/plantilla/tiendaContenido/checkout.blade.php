@extends('layouts.frondTienda.design')

@section('script')
<script>
	window.data={
    
        editar:'no',
		datos:{
			"envioFree":"{{$envioFree}}",
			"totalBs":"{{$totalBs}}",
			"totalPeso":"{{$totalPeso}}",
		}
      }
</script>

<script>
	$(function() {
    // Nav Tab stuff
    $('.nav-tabs > li > a').click(function() {
        if($(this).hasClass('disabled')) {
            return false;
        } else {
            var linkIndex = $(this).parent().index() - 1;
            $('.nav-tabs > li').each(function(index, item) {
                $(item).attr('rel-index', index - linkIndex);
            });
        }
    });
    $('#step-1-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.nav-tabs > li:nth-of-type(2) > a').removeClass('disabled').click();
        }
    });
    $('#step-2-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.nav-tabs > li:nth-of-type(3) > a').removeClass('disabled').click();
        }
    });
    $('#step-3-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.nav-tabs > li:nth-of-type(4) > a').removeClass('disabled').click();
        }
    });
});
</script>
@endsection
@section('style')
<style>
	/* Main tabs */
	@import url(http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700);



	.board {
		width: 100%;
		height: auto;
		margin: 30px auto;
		background: none;
	}

	.board .nav-tabs {
		position: relative;
		margin: 40px auto;
		margin-bottom: 0;
		box-sizing: border-box;
	}

	.liner {
		height: 2px;
		background: #ddd;
		position: absolute;
		width: 80%;
		margin: 0 auto;
		left: 0;
		right: 0;
		top: 50%;
		z-index: 1;
	}

	.nav-tabs>li {
		width: 25%;
	}

	.nav-tabs>li:after {
		content: " ";
		position: absolute;
		opacity: 0;
		margin: 0;
		margin-left: -10px;
		bottom: 0px;
		border: 10px solid transparent;
		border-bottom-color: #aaa;
		transition: left 1s;
	}

	.nav-tabs>li.active:after {
		left: 50%;
		opacity: 1;
	}

	.nav-tabs>li[rel-index="-1"]:after {
		left: calc(50% + 100%);
	}

	.nav-tabs>li[rel-index="-2"]:after {
		left: calc(50% + 200%);
	}

	.nav-tabs>li[rel-index="-3"]:after {
		left: calc(50% + 300%);
	}

	.nav-tabs>li[rel-index="1"]:after {
		left: calc(50% - 100%);
	}

	.nav-tabs>li[rel-index="2"]:after {
		left: calc(50% - 200%);
	}

	.nav-tabs>li[rel-index="3"]:after {
		left: calc(50% - 300%);
	}

	.nav-tabs>li a {
		width: 70px;
		height: 70px;
		line-height: 70px;
		margin: 20px auto;
		border-radius: 100%;
		padding: 0;
		border: none;
		background: none;
	}

	.nav-tabs>li a:hover {
		border: none;
		background: none;
	}

	.nav-tabs>li.active a,
	.nav-tabs>li.active a:hover {
		border: none;
		background: none;
	}

	.nav-tabs>li span {
		width: 70px;
		height: 70px;
		line-height: 70px;
		display: inline-block;
		border-radius: 100%;
		background: white;
		z-index: 2;
		position: absolute;
		left: 0;
		text-align: center;
		font-size: 25px;
	}

	.nav-tabs>li:nth-of-type(1) span {
		color: #3e5e9a;
		border: 2px solid #3e5e9a;
	}

	.nav-tabs>li:nth-of-type(1).active span {
		color: #fff;
		background: #3e5e9a;
	}

	.nav-tabs>li:nth-of-type(2) span {
		color: #f1685e;
		border: 2px solid #f1685e;
	}

	.nav-tabs>li:nth-of-type(2).active span {
		color: #fff;
		background: #f1685e;
	}

	.nav-tabs>li:nth-of-type(3) span {
		color: #febe29;
		border: 2px solid #febe29;
	}

	.nav-tabs>li:nth-of-type(3).active span {
		color: #fff;
		background: #febe29;
	}

	.nav-tabs>li:nth-of-type(4) span {
		color: #25c225;
		border: 2px solid #25c225;
	}

	.nav-tabs>li:nth-of-type(4).active span {
		color: #fff;
		background: #25c225;
	}

	.nav-tabs>li>a.disabled {
		opacity: 1;
	}

	.nav-tabs>li>a.disabled span {
		border-color: #ddd;
		color: #aaa;
	}

	div[role="tabpanel"]:after {
		content: "";
		display: block;
		clear: both;
	}

	/* Begin Business Info */

	#step-1 {
		background: white;
	}
</style>
@endsection

@section('contenido')s

<div id="checkout">

	@php
	use App\Producto;
	use App\Combinacion;
	@endphp


	<div class="container " style="margin-bottom:10%;" id="cart_items">
		<div class="row">
			<div class="board">
				<ul class="nav nav-tabs">
					<div class="liner"></div>
					<li rel-index="0" class="active">
						<a href="#step-1" class="btn" aria-controls="step-1" role="tab" data-toggle="tab">
							<span><i class="fa fa-map-marker"></i></span>
						</a>
					</li>
					<li rel-index="1">
						<a href="#step-2" class="btn disabled" aria-controls="step-2" role="tab" data-toggle="tab">
							<span><i class="fa fa-truck"></i></span>
						</a>
					</li>
					<li rel-index="2">
						<a href="#step-3" class="btn disabled" aria-controls="step-3" role="tab" data-toggle="tab">
							<span><i class="fa fa-shopping-cart"></i></span>
						</a>
					</li>
					<li rel-index="3">
						<a href="#step-4" class="btn disabled" aria-controls="step-4" role="tab" data-toggle="tab">
							<span><i class="fa fa-credit-card"></i></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="step-1">
					<div class="col-md-12">
						<div class="shopper-info" v-if="agregarDireccion==false">
							<div class="row">

								<div class="col-md-6">
									<p>Dirección de entrega</p>

									<div class="col-md-6" v-for="direccion in direcciones">
										<div class="panel panel-primary mb-3">

											<div class="panel-heading">
												<div class="form-group">
													<input type="radio" 
														class="pull-right" :value="direccion.id" 
														@click="medioEnvio(direccion)" 
														name="direccionEnvio">
													<h5>@{{direccion.nombre}} @{{direccion.apellido}}</h5>

												</div>
											</div>

											<div class="panel-body">

												@{{direccion.direccionExacta}}<br>
												@{{direccion.puntoReferencia}}<br>
												@{{direccion.primerTelefono}}<br>
												@{{direccion.codigoPostal}}

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
													<input type="radio" v-model="direccionFactura" class="pull-right" :value="direccion.id" name="direccionFactura">
													<h5>@{{direccion.nombre}} @{{direccion.apellido}}</h5>
												</div>
											</div>
											<div class="panel-body">

												@{{direccion.direccionExacta}}<br>
												@{{direccion.puntoReferencia}}<br>
												@{{direccion.primerTelefono}}<br>
												@{{direccion.codigoPostal}}
											</div>

										</div>
									</div>

								</div>
							</div>
							<div class="row my-2">
								<div class="col-sm-12">


									<button @click.prevent="agregarDireccion=true"
										class="btn btn-primary float-left">Agregar nueva dirección</button>

									<button id="step-1-next"
										class="btn btn-lg btn-primary nextBtn pull-right">Siguiente</button>


								</div>
							</div>
						</div>





						<div class="col-sm-6 clearfix " v-if="agregarDireccion==true">
							<div class="bill-to">
								<p>Agregar dirección para la factura</p>

								<form action="{{url('/comprador/direccion')}}" method="post">

									@csrf
									<div>

										<div class="form-one">

											<div class="form-group">

												<input type="text" class="form-control" required="true" name="nombre"
													id="nombre" placeholder="Nombre"
													value="{{\Auth::user()->comprador->nombre}}">
												{!!$errors->first('nombre','<small>:message</small><br>')!!}

											</div>

											<div class="form-group">

												<input type="text" class="form-control" required="true"
													class="form-control" name="apellido"
													value="{{\Auth::user()->comprador->apellido}}" id="apellido"
													placeholder="Apellido">
												{!!$errors->first('apellido','<small>:message</small><br>')!!}

											</div>

											<div class="form-group">
												<input type="hidden" name="monto" value="{{$totalBs}}">

												<select id="estado_id" class="form-control" v-model='estado_id'
													@change="getMunicipio()" name="estado_id">
													<option value="" selected>Seleccione un estado</option>
													<option :value="estado.id" v-for="(estado, index) in estados">
														@{{estado.nombre}}</option>
												</select>
											</div>

											<div class="form-group">
												<select id="municipio_id" class="form-control" v-model="municipio_id"
													@change="getParroquia()" name="municipio_id">
													<option value="" selected>Seleccione un municipio</option>
													<option :value="municipio.id"
														v-for="(municipio,index ) in municipios">
														@{{municipio.nombre}}</option>
												</select>
											</div>
											<div class="form-group">
												<select id="parroquia_id" class="form-control" @change="getZona()"
													v-model="parroquia_id" name="parroquia_id">
													<option value="" selected>Seleccione una parroquia</option>
													<option :value="parroquia.id"
														v-for="(parroquia,index ) in parroquias">
														@{{parroquia.nombre}}</option>
												</select>
											</div>
											<div class="form-group">
												<select id="zona_id" class="form-control" v-model="zona_id"
													@change="getCodigo()" name="zona_id">
													<option value="" selected>Seleccione una zona</option>
													<option :value="zona.id" v-for="(zona,index ) in zonas">
														@{{zona.nombre}}</option>
												</select>
											</div>



										</div>



										<div class="form-two">

											<div class="form-group">

												<input type="text" class="form-control" readonly name="codigoPostal"
													v-model="codigoPostal" placeholder="Código postal">
												{!!$errors->first('codigoPortal','<small>:message</small><br>')!!}
											</div>

											<div class="form-group">

												<input type="text" class="form-control" required="true" name="direccion"
													placeholder="Dirección exacta">
												{!!$errors->first('direccion','<small>:message</small><br>')!!}
											</div>


											<div class="form-group">

												<input type="text" class="form-control" required="true"
													name="puntoReferencia" id=puntoReferencia"
													placeholder="Punto de referencia">
												{!!$errors->first('puntoReferencia','<small>:message</small><br>')!!}
											</div>

											<div class="form-group">

												<input type="text" class="form-control" required="true"
													name="primerTelefono" placeholder="Primero telefono">
												{!!$errors->first('primerTelefono','<small>:message</small><br>')!!}

											</div>

											<div class="form-group">

												<input type="text" class="form-control" required="true"
													name="segundoTelefono" placeholder="Segundo telefono">
												{!!$errors->first('segundoTelefono','<small>:message</small><br>')!!}

											</div>
											<div class="form-group">

												<textarea name="descripcion" class="form-control" rows="3"
													placeholder="Ingrese una pequeña observación de su a cerca de su dirección"></textarea>
												{!!$errors->first('observacion','<small>:message</small><br>')!!}
											</div>

										</div>
									</div>

									<input type="hidden" name="checkout" value="si">
									<a @click.prevent="agregarDireccion=false" class="btn btn-default">Cancelar</a>

									<button type="submit" class="btn btn-success pull-right">Agregar
										dirección</button>
								</form>




							</div>
						</div>

					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="step-2">
					<div class="col-md-12">


						<div class="shopper-info">
							<div class="register-req  ">
								<div class="alert" role="alert">
									
								
									<div class="row">
										<div v-for="envio in metodoEnvio" class="col-sm-12">
											<span class="col-sm-3">
												<div>
													<input type="radio" name="envio"   :value="envio" 
														@click="seleccionEnvio(envio)">
													
													<label for="envio">@{{envio.nombre}}</label>

												</div>
											</span>

											<span class="col-sm-6">
												<label><strong>Entrega aproximadamente en
														@{{envio.tiempoEntrega}}</strong></label>
											</span>
											<span class="col-sm-3">
												<label v-if="envio.envioGratis=='A' || envio.precioEnvio==0">Gratis</label>
												<label v-else>BS @{{envio.precioEnvio}}</label>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>


						<button id="step-2-next" class="btn btn-lg btn-primary pull-right">Siguiente</button>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="step-3">
					<div class="col-md-12">

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
												@if($producto->imagen->count()<=0) <img style="width: 100px;"
													src="/imagenes/avatar.png">
													@else
													<img style="width: 100px;"
														src="{{$producto->imagen->random()->url}}">
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
													<td>Total del carrito</td>
													<td>Bs{{$montoTotal}}</</td> </tr> @if(\Auth::user()->
														comprador->tipoComprador->envioGratis===1)
												<tr class="shipping-cost">
													<td>Costo de envío</td>
													<td>Gratis</td>
												</tr>
												
												@else
												<tr class="shipping-cost">
													<td>Costo de envío</td>
													<td v-if="selectEnvio.precioEnvio==0">
														Gratis
													</td>
													<td v-else>
														Bs@{{selectEnvio.precioEnvio}}
													</td>
												</tr>
												@endif

												@if(!empty(\Session::get('montoCupon')))
													<tr class="shipping-cost">
														<td>Cupón</td>
														<td>
															
															Bs{{\Session::get('montoCupon')}}
														
														</td>
													</tr>
												@endif

												@if(\Session::get('$montoDescuentoTipoComrador')>0)
													<tr class="shipping-cost">
														<td>Descuento adicional</td>
														<td>
														
															Bs{{\Session::get('$montoDescuentoTipoComrador')}}

														
														</td>
													</tr>
													<tr>
												@endif
													<td>Monto Total</td>


													<td><span>Bs@{{precioFijoBs}}</span></td>
												</tr>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<button id="step-3-next" class="btn btn-lg btn-primary pull-right">Siguiente</button>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="step-4">
					<div class="col-md-12">
						

						<form name="paymentForm" method="post" id="paymentForm" action="{{url('/realizar-pedido')}}">
							@csrf
							
							<input type="hidden" name="precioFijoBs"  v-model="precioFijoBs">
							
							
							<input type="hidden" v-model="selectEnvio.precioEnvio" name="envioGratis">
							

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
		
											<label for="">Monto restante en bolivares <span class="label label-info">Bs @{{totalBs}}</span></label>
										</div>
										<div class="col-sm-12">
											<label for="">Monto restante en dolares <span class="label label-info">$ @{{totalDolar}}</span></label>
										</div>
									</div>	
								
		
							
		
								<div class="row">
		
									<div class="form-group col-sm-6" >
										<span>
											En esta sección podrás pagar tu pedido con multiples metodos de pago. Selecciona los metodos de pagos, he indica la cantidad a cancelar con ese método de pago.
											
											Tu pedido estará en espera por transferencia hasta que todos tus pagos sean verificados.

											Los datos bancarios serán enviados a su correo. 
										</span>
									</div>
		
								</div>
		
								<!-- Material checked -->

							
								<div class="row">
									<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
										<li class="nav-item active">
										  <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Transferencia nacionales</a>
										</li>
										<li class="nav-item">
										  <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Transferencias internacionales</a>
										</li>
									
									  </ul>
									  <div class="tab-content" style="margin-top: 5px;" id="pills-tabContent">
										<div class="tab-pane active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
											
											<div v-for="(pago,index) in arrayNacional" >
												<div class="panel panel-primary mt-3  col-sm-4">
													<div class="panel-heading">
														<input type="checkbox" 
																:value="pago" class="pull-right"
																v-model.numer="seletedMetodoPago" >
														<h5>@{{pago.nombre}}</h5>
													</div>
													<div class="panel-body">
			
														<div class="form-group col-sm-6">
															
															<span><label class="mx-1" for="">Monto bs</label><input class=" form-control pull-right"   v-model.numer="pago.cantidad" type="text"></span>
															
														</div>
													</div>
												</div>
											</div>

										</div>
										<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
											
											<div v-for="(pago,index)  in arrayInternacional" >
												<div class="panel panel-primary mt-3 col-sm-4">
													<div class="panel-heading">
														<div class="form-group">
															<input type="checkbox"
																	:value="pago" class="pull-right"
																	v-model.numer="seletedMetodoPago">
															<h5>@{{pago.nombre}}</h5>
														</div>
													</div>
													<div class="panel-body">
														<div class="form-group col-sm-6">
															<span><label class="mx-1" for="">Monto $</label><input class=" form-control pull-right"  v-model.numer="pago.cantidad" type="text"></span>
														</div>
													</div>
												</div>
											</div>

										</div>
										
									  </div>
								</div>	
		
								</div>
							</div>
						</div>		
						<div class="row">
							<div class="col-sm-12">
		
								<button type="submit" :disabled="totalBs!=0"  class="btn btn-primary pull-right">Confirmar pago</button>
								
								<button @click.prevent="calcularRestante()" class="btn btn-secondary">Calcular restante</button>
							</div>
						</div>					
					</form>

					</div>

				</div>
			</div>
		</div>
	</div>
</div>



</div>

@endsection