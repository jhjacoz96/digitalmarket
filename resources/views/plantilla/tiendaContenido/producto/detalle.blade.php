@extends('layouts.frondTienda.design')
@section('script')
@php
    use App\Producto;
@endphp
    <script>
        window.data={
            datos:{
                "slug":"{{$producto->slug}}",
                "cantidad":"{{$producto->cantidad}}",
                "tipoProducto":"{{$producto->tipoCliente}}"
            }
        }

    </script>
    <script>
        $(document).ready(function(){
            $(".changeImage").click(function(){
                var image=$(this).attr('src')
                $(".mainImage").attr("src",image)
               
            })
        })
        
    </script>
@endsection
@section('contenido')
<div id="detalleProducto">
<section>
    <div class="container">
        <div class="p-2">
            @include('flash::message')
        </div>
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.frondTienda.sider')
            </div>
            
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            
                            @if($producto->imagen->count()<=0)
                                    <img  src="/imagenes/avatar.png" >
                            @else
                                <img class="mainImage"
                               
                                src="{{$producto->imagen->random()->url}}" >
                            @endif
                           
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            
                              <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                   
                                        
                                    <div class="item active">
                                      
                                            @foreach ($producto->imagen as $item)

                                                <img 
                                                class="changeImage"
                                                style="width: 70px;" src="{{$item->url}}" alt="">
                                                
                                            @endforeach

                                        

                                    </div>

                                    
                                </div>

                              <!-- Controls -->
                            <!--  <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                              </a>
                              <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a>-->
                        </div>

                    </div>
                    <div class="col-sm-7">
                    
                    <form action="{{route('agregarCarrito')}}" method="post">
                           {{ csrf_field() }} 

                        <input type="hidden" name="producto_id" value="{{$producto->id}}">
                      
                       <input type="hidden" name="precio" value="{{$producto->precioActual}}">
                       <input type="hidden" name="cantidad" v-model="cantidad">
            

                        <div class="product-information">
                         
                            <div align="left"><?php echo $miga; ?></div>
                            <div>&nbsp;</div>
                        <h2>{{$producto->nombre}}</h2>
                            <p>Sku: {{$producto->sku}}</p>
                        
                            @if($producto->tipoCliente=='combinacion')
                            <input type="hidden" name="combinacion_id" v-model="combinacion_id">
                            <div v-if="count==1">
                                <p v-for="(grupo,index) in grupoCombinacion">
                                    <select @change="obtenerCombinacion" v-model="atributo_id"  id="selected">
                                        <option selected value="">@{{grupo.nombre}}</option>
                                        <option v-for="(atributo,index) in grupo.atributo" :value="atributo.id">@{{atributo.nombre}}</option>
                                    </select>
                                </p>  
                            </div>
                            <div v-if="count==2">
                            <p >
                                <select @change="obtenerCombinacion2" v-model="atributo_id"  id="selected">
                                    <option selected value="">@{{grupoCombinacion2.nombre}}</option>
                                    <option v-for="(atributo,index) in grupoCombinacion2.atributo" :value="atributo.id">@{{atributo.nombre}}</option>
                                </select>
                            </p>

                            <p>
                                    
                                <select @change="obtenerCombinacion2" v-model="atributo_id2"  id="selected2">
                                    <option selected value="">@{{grupoCombinacion3.nombre}}</option>
                                    <option v-for="(atributo,index) in grupoCombinacion3.atributo" :value="atributo.id">@{{atributo.nombre}}</option>
                                </select>
                            </p>  
                        </div>
                            @endif
                          
                            
                            
                            <img src="{{asset('shop/images/product-details/rating.png')}}" alt="" />
                            <span>
                                <span>Bs {{$producto->precioActual}}</span>
                                @php
                                 $moneda=Producto::obtenerMoneda($producto->precioActual);   
                                @endphp
                             
                                <h2>$ {{$moneda}}</h2>
                                <label>Cantidad:</label>
                                <input type="text" v-model="cantidad"   />
                                @{{validarCantidad}}
                                <button type="submit"  class="btn btn-fefault cart" :disabled="disabledBoton">
                                    <i class="fa fa-shopping-cart"></i>
                                    Agregar al carrito
                                </button>
                            </span>
                            <p style="color: tomato;"  v-if="mostrarMensaje">@{{mensaje}}</p>
                                <br v-if="mostrarMensaje">
                        <p><b>Disponibilidad:</b>
                            @if($producto->tipoCliente=='comun')
                                {{$producto->cantidad}}
                            @else
                                @{{disponibilidad}}
                            @endif


                        </p>
                            
                    <p><b>Tienda:</b> {{$producto->tienda->nombreTienda}}</p>
                            
                        </div><!--/product-information-->
                    </form>
                    </div>
                </div><!--/product-details-->
                
                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#descripcionLarga" data-toggle="tab">Descripcion larga</a></li>
                            <li><a href="#especificacion" data-toggle="tab">Especificaciones</a></li>
                            <li ><a href="#envio" data-toggle="tab">Opción de envios</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="descripcionLarga" >
                           <div class="col-sm-12">
                               <p>{!!$producto->descripcionLarga!!}</p>
                           </div>
                       
                        </div>
                        
                        <div class="tab-pane fade" id="especificacion" >
                            <div class="col-sm-12">
                               <p>{!!$producto->especificaciones!!}</p>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="envio" >
                            <div class="col-sm-12">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus delectus sunt hic commodi culpa non ab optio? Autem, totam est sed, error iste reiciendis iusto commodi excepturi cupiditate laudantium laboriosam.</p>
                            </div>
                        </div>
                        
                        
                    </div>
                </div><!--/category-tab-->
                
                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Articulos recomentados</h2>
                    
                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                           <?php
                                $count=1;
                           ?> 
                            @foreach ($relacionProducto->chunk(3) as $chunk)
                                <div <?php if($count==1){  ?> 
                                class="item active" <?php }else{ ?> class="item" <?php } ?>>
                                    @foreach ($chunk as $item)
                                
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                   
                                                    @if($item->imagen->count()<=0)
                                                        <img style="width:140px;"  src="/imagenes/avatar.png" >
                                                    @else
                                                        <img 
                                                        style="width:140px;"
                                                        src="{{$item->imagen->random()->url}}">
                                                    @endif
                                                 
                                                        <h2>{{$item->precioActual}}</h2>
                                                        <p>{{$item->nombre}}</p>
                                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Ver detalles</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach 
                                   
                                </div>
                                <?php
                                $count++;
                                ?> 
                            @endforeach
                          
                        </div>
                         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                          </a>
                          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                          </a>			
                    </div>
                </div><!--/recommended_items-->
                
            </div>
        </div>
    </div>
</section>
</div>
@endsection