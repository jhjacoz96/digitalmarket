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
@section('style')    
<style>

  

</style>
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

                              
                        </div>

                    </div>
                    <div class="col-sm-7 ">
                    
                    <form action="{{route('agregarCarrito')}}" method="post">
                           {{ csrf_field() }} 

                        <input type="hidden" name="producto_id" value="{{$producto->id}}">
                      
                       <input type="hidden" name="precio" value="{{$producto->precioActual}}">
                       <input type="hidden" name="cantidad" v-model="cantidad">
            

                        <div class="product-information">
                         
                            <div align="left"><?php echo $miga; ?></div>
                            <div>&nbsp;</div>
                        <h2 style="color:#FE980F;">{{$producto->nombre}}</h2>
                        <button type="submit" name="deseo" value="deseo" class="btn btn-fefault" :disabled="disabledBoton">
                            <i class="fa fa-heart"></i>
                            Agregar a lista de deseo
                        </button>
                        <div>&nbsp;</div>
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
                        
                            <span>
                                <span>Bs {{$producto->precioActual}}</span><br>
                                @if($producto->porcentajeDescuento!=0)
                                <h4>Bs {{$producto->precioAnterior}}</h4>
                                @endif
                                @php
                                 $moneda=Producto::obtenerMoneda($producto->precioActual);   
                                @endphp
                             
                                <h2>$ {{$moneda}}</h2>
                                <label>Cantidad:</label>

                                <input type="text" v-model="cantidad"/>
                                <button type="submit" name="carrito"  class="btn btn-fefault cart" :disabled="disabledBoton">
                                    <i class="fa fa-shopping-cart"></i>
                                    Agregar al carrito
                                </button>
                                @{{validarCantidad}}
                                <p class="label label-warning"  v-if="mostrarMensaje">@{{mensaje}}</p>
                                <br v-if="mostrarMensaje">

                            </span>
                                    
                        
                            
                            <p><b>Disponibilidad:</b>
                            <div v-if="disponibilidad!=0">
                                @{{disponibilidad}}
                            </div>
                            <div v-else>
                                <p>Producto sin stock</p>
                            </div>
                           


                        </p>
                            
                        <p><b>Tienda:</b> {{$producto->tienda->nombreTienda}}</p>
                         @if(!empty($producto->marca->imagen))
                         <p><b>Marca:</b>
                         <img src="{{$producto->marca->imagen->url}}" style="width:150px; ">    
                         </p>
                         @endif  

                        </div><!--/product-information-->
                    </form>
                    </div>
                </div><!--/product-details-->
                
                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#descripcionLarga" data-toggle="tab">Descripcion larga</a></li>
                            <li><a href="#especificacion" data-toggle="tab">Especificaciones</a></li>
                            <li ><a href="#calificacion" data-toggle="tab">Calificaciones</a></li>
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
                        
                        <div class="tab-pane fade" id="calificacion" >

                            <div class="col-sm-12 " style="padding: 2%;">
                                <div class="row " style="margin-bottom: 3%;">
                                    <div class="col-sm-6">
                                        <div class="col-sm-3">

                                            <span style="font-size: 45px;" class=" pull-left title-heading">
                                                {{$promedio}}
                                            </span>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="pull-right" style="margin-right: 40px; font-size: 22px;">
                                                @if($formatPromedio==='5')
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                
                                                @endif
                                                @if($formatPromedio==='4')
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                
                                                @endif
                                                @if($formatPromedio==='3')
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                
                                                @endif
                                                @if($formatPromedio==='2')
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                
                                                @endif
                                                @if($formatPromedio==='1')
                                                <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                
                                                @endif
                                            </p>
                                            <p>
                                                Promedio entre {{count($producto->calificacion)}} @if(count($producto->calificacion)>1) comentarios @endif @if(count($producto->calificacion)<2) comentario @endif

                                              
                                            </p>
                                        </div>
                                           
                                       
                                    </div>
                                </div>
                                

                                @foreach ($producto->calificacion as $item)
                                <div class="panel  panel-default ">   
                                    <div class="panel-body">         
                                        <h4 class="title-heading">

                                            <p  class="clasificacion">
                                                <span >

                                                    {{$item->titulo}} 
                                                </span>
                                                   
                                                    @if($item->calificacion===5)
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    
                                                    @endif
                                                    @if($item->calificacion===4)
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                    
                                                    @endif
                                                    @if($item->calificacion===3)
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                    
                                                    @endif
                                                    @if($item->calificacion===2)
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                    
                                                    @endif
                                                    @if($item->calificacion===1)
                                                    <span style="color: #FE980F;"><i class="fa fa-star"></i></span>
                                                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                    <span style="color: aliceblue;"><i class="fa fa-star"></i></span>
                                                    
                                                    @endif
                                                
                                            
                                            </p>
                                        </h4>
                                    
                                        
                                        {{$item->comentario}}
                                    
                                    </div>
                                </div>
                                @endforeach
                                  
                           
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