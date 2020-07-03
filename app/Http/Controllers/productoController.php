<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Producto;
use App\Categoria;
use App\SubCategoria;
use App\Combinacion;
use App\Atributo;
use App\Imports\ProductosImport;
use App\Tienda;
use App\Direccion;
use App\GrupoAtributo;
use App\Imagen;
use App\Carrito;
use App\Calificacion;
use App\TipoComprador;
use App\MetodoPago;
use App\BancoMetodoPago;
use App\MedioEnvio;
use App\DireccionPedido;
use App\DireccionFactura;
use App\Pedido;
use App\Comprador;
use App\Deseo;
use App\Marca;
use App\Notifications\pedidoNotification;


use Illuminate\Support\Facades\File;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;


class productoController extends Controller
{

   /* public function __construct()
    {
        $this->middleware('auth');
    }*/
    

    public function index(Request $request)
    {
        
        
        if(\Auth::user()->rol_id==3){
            
            $nombre=$request->get('nombre');
              
              $producto=Producto::with('imagen','subCategoria')->where('nombre','like',"%$nombre%")->get();
              
              return view('plantilla.contenido.admin.producto.consultar',compact('producto'));

        }else{

            $nombre=$request->get('nombre');
              
              $producto=Producto::with('imagen','subCategoria')->where('nombre','like',"%$nombre%")->where('tienda_id',\Auth::user()->tienda->id)->get();
              
              return view('plantilla.contenido.tienda.producto.consultar',compact('producto'));

        }
    
    }

    
    

    public function Categoria(){
        $categoria=Categoria::orderBy('nombre')->get();
        return $categoria;
    }

    public function create()
    {
        $categoria=Categoria::orderBy('nombre')->get();
        $marca=Marca::orderBy('nombre')->where('status','A')->get();
        if(\Auth::user()->rol_id==3){
            $rol=\Auth::user()->rol_id;
        return \view('plantilla.contenido.admin.producto.crear',compact('categoria','rol','marca'));
        }else{
            $planAfiliacion=\Auth::user()->tienda->planAfiliacion;

            if($planAfiliacion->cantidadPublicacion!=''){
                $tienda=\Auth::user()->tienda;
                $cantidad=Producto::where('tienda_id',$tienda->id)->where('status','si')->count();
                if($cantidad+1>$planAfiliacion->cantidadPublicacion){
                    $producto=Producto::where('tienda_id',$tienda->id)->get();
                    \flash('Ha superado la cantidad de productos activos. Si desea seguir publicando productos, debe afiliace a uno de nuestros planes con mayor cantidad de publicaciones.')->warning()->important();
                    return redirect()->route('tiendas.producto.index',compact('producto'));
                }

            }
            $rol=\Auth::user()->rol_id;
            $tienda_id=\Auth::user()->tienda->id;
            return \view('plantilla.contenido.tienda.producto.crear',compact('categoria','tienda_id','rol','marca'));   
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $v=Validator::make($request->all(),[
            'nombre'=>'min:2|required|unique:productos,nombre',
            'slug'=>'min:2|required|unique:productos,slug',
            'peso'=>'required',
            'imagenes.*'=>'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
        

        
        $urlImagenes=[];
        if ($request->hasFile('imagenes')) {
            
            $imagenes=$request->file('imagenes');

            foreach ($imagenes as $imagen) {

                $nombre=time().'_'.$imagen->getClientOriginalName();
                $ruta=public_path().'/imagenes';
                $imagen->move($ruta , $nombre);

                $urlImagenes[]['url']='/imagenes/'.$nombre;

            }
            //return $urlImagenes;
        }
        
        
        if(\Auth::user()->rol_id==3){

            $tienda=Tienda::where('codigo',$request->tienda)->first();
            $planAfiliacion=$tienda->planAfiliacion;
    
                if($planAfiliacion->cantidadPublicacion!=''){
                  
                    $cantidad=Producto::where('tienda_id',$tienda->id)->where('status','si')->count();
                    if($cantidad+1>$planAfiliacion->cantidadPublicacion){
                        $producto=Producto::All();
                        \flash('Ha superado la cantidad de productos activos. Si desea seguir publicando productos, debe afiliarse a uno de nuestros planes con mayor cantidad de publicaciones.')->warning()->important();
                        return redirect()->route('producto.index',compact('producto'));
                    }
                }

              
        }
        
        if($request->tipoProd=='combinacion'){
            $d=json_decode(($request['value']),true);
            if($d!=null){
                $cantidad=0;
                for ($i=0; $i < count($d) ; $i++) { 
                    $cantidad=$cantidad+$d[$i]['cantidad'];
                }
                $request->cantidad=$cantidad;
              
                    if(\Auth::user()->rol_id==3){
                        $tienda=Tienda::where('codigo',$request->tienda)->first();
                        $planAfiliacion=$tienda->planAfiliacion;
                       
                        if($planAfiliacion->tiempoPublicacion!=''){

                            if($cantidad>$planAfiliacion->tiempoPublicacion){
                                
                                $producto=Producto::All();
                                \flash('Ha superado el stock maximo del plan de afiliación al que pertenece. Si desea tener un limite mayor puede cambiar su plan de afiliación .')->warning()->important();
                                return redirect()->route('tiendas.producto.index',compact('producto'));
                                
                            }
                        }

                    }else{

                        $tienda=\Auth::user()->tienda;
                        $planAfiliacion=$tienda->planAfiliacion;
                        $f=$planAfiliacion->tiempoPublicacion;

                        if($planAfiliacion->tiempoPublicacion!=''){

                            if($cantidad>$planAfiliacion->tiempoPublicacion){
                                
                                \flash('Ha superado el stock maximo del plan de afiliación al que pertenece. Si desea tener un limite mayor puede cambiar su plan de afiliación .')->warning()->important();
                                
                                    $producto=Producto::where('tienda_id',$tienda->id)->get();
                                    return redirect()->route('tiendas.producto.index',compact('producto'));
                                
                           
                            }
                        }
                    }
                    
              
            }
        }else{
            if(\Auth::user()->rol_id==3){
                $tienda=Tienda::where('codigo',$request->tienda)->first();
                $planAfiliacion=$tienda->planAfiliacion;
            
                if($planAfiliacion->tiempoPublicacion!=''){
                    if($request->cantidad>$planAfiliacion->tiempoPublicacion){
                        
                        $producto=Producto::All();
                        \flash('Ha superado el stock maximo del plan de afiliación al que pertenece. Si desea tener  un limite mayor puede cambiar su plan de afiliación .')->warning()->important();
                        return redirect()->route('tiendas.producto.index',compact('producto'));
                    }
                }

            }else{
                $tienda=\Auth::user()->tienda;
                $planAfiliacion=$tienda->planAfiliacion;
                $f=$planAfiliacion->tiempoPublicacion;

                if($planAfiliacion->tiempoPublicacion!=''){
                    if($request->cantidad>$planAfiliacion->tiempoPublicacion){
                        
                        \flash('Ha superado el stock maximo del plan de afiliación al que pertenece. Si desea tener un limite mayor puede cambiar su plan de afiliación .')->warning()->important();
                        
                            $producto=Producto::where('tienda_id',$tienda->id)->get();
                            return redirect()->route('tiendas.producto.index',compact('producto'));
    
                    }
                }
            }
        }

      


        $producto= new Producto();

        $producto->nombre=$request->nombre;
        $producto->slug=$request->slug;
        $producto->cantidad=$request->cantidad;
        $producto->peso=$request->peso;

        if(!empty($request->minStock)){
            $producto->notificarStock=$request->minStock;
        }

        $producto->subCategoria_id=$request->subCategoria_id;
        $producto->precioAnterior=$request->precioAnterior;
        $producto->precioActual=$request->precioActual;
        $producto->marca_id=$request->marca;
        $producto->porcentajeDescuento=$request->porcentajeDescuento;
        $producto->descripcionCorta=$request->descripcionCorta;
        $producto->descripcionLarga=$request->descripcionLarga;
        $producto->especificaciones=$request->especificaciones;
        $producto->datosInteres=$request->datosInteres;
    
        
        if(\Auth::user()->rol_id==2){

            $tiendaCodigo=\Auth::user()->tienda->codigo;
            $subCategoria=SubCategoria::find($request->subCategoria_id);
            $subCategoriaId=strtoupper($subCategoria->id);
            
            $categoria=Categoria::find($subCategoria->categoria->id);
            $categoriaId=strtoupper($categoria->id);
            $numero=count(Producto::All()) + 1;
           if($request->tipoProd=='combinacion'){
               $sku=$tiendaCodigo.'-'. 0 .$categoriaId.'-'. 0 . $subCategoriaId.'-'.'CB'.'-'.$numero;
            }else{
                $sku=$tiendaCodigo.'-'. 0 .$categoriaId.'-'. 0 . $subCategoriaId.'-'.'CM'.'-'.$numero;
           }

        $producto->sku=$sku;
        $producto->tienda_id=\Auth::user()->tienda->id;

            
        if($request->sliderPrincipal){
            $producto->sliderPrincipal='si';
        }else{  
            $producto->sliderPrincipal='no';
        }

        if($request->status){
            $producto->status='si';
        }else{
            $producto->status='no';
        }

        if($request->tipoProd=='comun'){
            $producto->tipoCliente='comun';
        }else{

            if($request->tipoProd=='combinacion'){
    
                $producto->tipoCliente='combinacion';
            }
        }
        
    
  

        $producto->save();

        $producto->imagen()->createMany($urlImagenes);

        if($producto->tipoCliente=='combinacion'){
            $d=json_decode(($request['value']),true);
            if($d!=null){
                for ($i=0; $i < count($d) ; $i++) { 
                    $combinacion = new Combinacion();
                    $combinacion->cantidad=$d[$i]['cantidad'];
                    $combinacion->status='A';
                    $combinacion->producto_id=$producto->id;
                    $combinacion->save();
                    $s=$d[$i]['elemento'];
                    for ($j=0; $j <count($s) ; $j++) { 
                        $combinacion->atributo()->attach($s[$j]['id']);
                    }
                }
            }
        }
       \flash('Producto creado con exito')->success()->important();

        return \redirect()->route('tiendas.producto.index');

        }else{
            $tienda=Tienda::where('codigo',$request->tienda)->first();

            $tiendaCodigo=$tienda->codigo;
            $subCategoria=SubCategoria::find($request->subCategoria_id);
            $subCategoriaId=strtoupper($subCategoria->id);
            
            $categoria=Categoria::find($subCategoria->categoria->id);
            $categoriaId=strtoupper($categoria->id);
            $numero=count(Producto::All()) + 1;
           if($request->tipoProd=='combinacion'){
               $sku=$tiendaCodigo.'-'. 0 .$categoriaId.'-'. 0 . $subCategoriaId.'-'.'CB'.'-'.$numero;
            }else{
                $sku=$tiendaCodigo.'-'. 0 .$categoriaId.'-'. 0 . $subCategoriaId.'-'.'CM'.'-'.$numero;
           }
        
        $producto->sku=$sku;
        $producto->tienda_id=$tienda->id;

            
        if($request->sliderPrincipal){
            $producto->sliderPrincipal='si';
        }else{  
            $producto->sliderPrincipal='no';
        }

        if($request->status){
            $producto->status='si';
        }else{
            $producto->status='no';
        }

        if($request->tipoProd=='comun'){
            $producto->tipoCliente='comun';
        }else{

            if($request->tipoProd=='combinacion'){
    
                $producto->tipoCliente='combinacion';
            }
        }
        
  

        $producto->save();

        $producto->imagen()->createMany($urlImagenes);

        if($producto->tipoCliente=='combinacion'){    
            $d=json_decode(($request['value']),true);
            if($d!=null){
                for ($i=0; $i < count($d) ; $i++) { 
                    $combinacion = new Combinacion();
                    $combinacion->cantidad=$d[$i]['cantidad'];
                    $combinacion->producto_id=$producto->id;
                    $combinacion->save();
                    $s=$d[$i]['elemento'];
                    for ($j=0; $j <count($s) ; $j++) { 
                        $combinacion->atributo()->attach($s[$j]['id']);
                    }
                }
            }
        }
       \flash('Producto creado con exito')->success()->important();

        return \redirect()->route('producto.index');

        }

        //$Producto->tipoProducto=$request->tipoProd;



    }

    public function getSubCategoria($id){
        
    $subCategorias=SubCategoria::where('categoria_id',$id)->get();
           return $subCategorias;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        if(Producto::where('slug',$slug)->first()){
            return 'slug existe';
        }
        else{
            return 'Slug disponible';
        }
    }

    public function eliminarImagen($id)
    {

        //return 'elimado'.$id;
        $imagen=Imagen::findOrFail($id);
        $archivo=substr($imagen->url,1);
        $eliminar=File::delete($archivo);
        $imagen->delete();

        return "eliminado id:".$id.''.$eliminar; 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
     
        $producto=Producto::with('imagen','subCategoria','combinacion')->where('slug',$slug)->firstOrFail();
        
        $categoria=Categoria::orderBy('nombre')->get();
        $marca=Marca::orderBy('nombre')->get();
        
        if(\Auth::user()->rol_id==3){
            $rol=\Auth::user()->rol_id;
        return view('plantilla.contenido.admin.producto.modificar',compact('producto','categoria','rol','marca'));
        }else{
            $rol=\Auth::user()->rol_id;
            $tienda_id=\Auth::user()->tienda->id;
           
            return view('plantilla.contenido.tienda.producto.modificar',compact('producto','categoria','rol','tienda_id','marca'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $v=Validator::make($request->all(),[
            'nombre'=>'min:2|required|unique:productos,nombre,'.$id,
            'slug'=>'min:2|required|unique:productos,slug,'.$id,
            'peso'=>'required',
            'imagenes.*'=>'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        $urlImagenes    =[];

        if ($request->hasFile('imagenes')) {
            
            $imagenes=$request->file('imagenes');

            foreach ($imagenes as $imagen) {

                $nombre=time().'_'.$imagen->getClientOriginalName();
                $ruta=public_path().'/imagenes';
                $imagen->move($ruta , $nombre);

                $urlImagenes[]['url']='/imagenes/'.$nombre;

            }
            //return $urlImagenes;
        }

        
            if(\Auth::user()->rol_id==3){
           
                $tienda=Tienda::where('codigo',$request->tienda)->with('planAfiliacion')->first();
                
                $planAfiliacion=$tienda->planAfiliacion;
            
                if($planAfiliacion->tiempoPublicacion!=''){

                    if($request->cantidad>$planAfiliacion->tiempoPublicacion){
                        
                        $producto=Producto::All();
                        \flash('Ha superado el stock maximo del plan de afiliación al que pertenece. Si desea tener un limite mayor puede cambiar su plan de afiliación .')->warning()->important();
                        return redirect()->route('tiendas.producto.index',compact('producto'));
                    }
                }

            }else{
                $tienda=\Auth::user()->tienda;
                $planAfiliacion=$tienda->planAfiliacion;
                $f=$planAfiliacion->tiempoPublicacion;

                if($planAfiliacion->tiempoPublicacion!=''){
                    if($request->cantidad>$planAfiliacion->tiempoPublicacion){
                        
                        \flash('Ha superado el stock maximo del plan de afiliación al que pertenece. Si desea tener un limite mayor puede cambiar su plan de afiliación .')->warning()->important();
                        
                            $producto=Producto::where('tienda_id',$tienda->id)->get();
                            return redirect()->route('tiendas.producto.index',compact('producto'));

                    }
                }
            }
        




        $producto=Producto::findOrFail($id);

        $producto->nombre=$request->nombre;
        $producto->slug=$request->slug;
        $producto->peso=$request->peso;
        if($producto->tipoCliente=='comun'){
            $producto->cantidad=$request->cantidad;
        }
        if(!empty($request->minStock)){
            $producto->notificarStock=$request->minStock;
        }
        $producto->subCategoria_id=$request->subCategoria_id;
        $producto->precioAnterior=$request->precioAnterior;
        $producto->precioActual=$request->precioActual;
        $producto->marca_id=$request->marca;
        $producto->porcentajeDescuento=$request->porcentajeDescuento;
        $producto->descripcionCorta=$request->descripcionCorta;
        $producto->descripcionLarga=$request->descripcionLarga;
        $producto->especificaciones=$request->especificaciones;
        $producto->datosInteres=$request->datosInteres;
        $producto->status=$request->status;
        
        if($request->sliderPrincipal){
            $producto->sliderPrincipal='si';
        }else{  
            $producto->sliderPrincipal='no';
        }

        if($request->status){

            if(\Auth::user()->rol_id==3){
                $tienda=Tienda::where('codigo',$request->tienda)->first();
                $planAfiliacion=$tienda->planAfiliacion;
        
                    if($planAfiliacion->cantidadPublicacion!=''){
                      
                        $cantidad=Producto::where('tienda_id',$tienda->id)->where('status','si')->count();
                        if($cantidad+1>$planAfiliacion->cantidadPublicacion){
                            $producto=Producto::All();
                            \flash('Ha superado la cantidad de productos activos. Si desea seguir publicando productos, debe afiliace a uno de nuestros planes con mayor cantidad de publicaciones.')->warning()->important();
                            return redirect()->route('producto.index',compact('producto'));
                        }
                    }
    
                  
            }else{

                $planAfiliacion=\Auth::user()->tienda->planAfiliacion;

                if($planAfiliacion->cantidadPublicacion!=''){
                    $tienda=\Auth::user()->tienda;
                    $cantidad=Producto::where('tienda_id',$tienda->id)->where('status','si')->count();
                    if($cantidad+1>$planAfiliacion->cantidadPublicacion){
                        $producto=Producto::where('tienda_id',$tienda->id)->get();
                        \flash('Ha superado la cantidad de productos activos. Si desea seguir publicando productos, debe afiliace a uno de nuestros planes con mayor cantidad de publicaciones.')->warning()->important();
                        return redirect()->route('tiendas.producto.index',compact('producto'));
                    }

                }



            }

                $producto->status='si';
            

        }else{
            $producto->status='no';
        }

        if($request->tipoProd=='comun'){
            $producto->tipoCliente='comun';
        }else{

            if($request->tipoProd=='combinacion'){
    
                $producto->tipoCliente='combinacion';
            }
        }
        
        if(\Auth::user()->rol_id==3){
            $producto->tienda->id=$request->tienda_id;
        }else{
            $producto->tienda_id=\Auth::user()->tienda->id;
        }

        $producto->save();

        $producto->imagen()->createMany($urlImagenes);
        if($producto->tipoCliente=='combinacion'){
            $d=json_decode(($request['value']),true);
            if($d!=null){
                for ($i=0; $i < count($d) ; $i++) { 
                    $combinacion = new Combinacion();
                    $combinacion->cantidad=$d[$i]['cantidad'];
                    $combinacion->producto_id=$producto->id;
                    $combinacion->save();
                    $s=$d[$i]['elemento'];
                    for ($j=0; $j <count($s) ; $j++) { 
                        $combinacion->atributo()->attach($s[$j]['id']);
                    }
                }
            }
        }

       \flash('Producto actualizado con exito')->success()->important();
        if(\Auth::user()->rol_id==3){

            return \redirect()->route('producto.edit',$producto->slug);
        }else{
            return \redirect()->route('tiendas.producto.edit',$producto->slug);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto=Producto::with('imagen')->findOrFail($id);
        
        /*
        foreach ($producto->imagen as $imagen) {
           
            $archivo=substr($imagen->url,1);
            File::delete($archivo);
            $imagen->delete();
        }*/

        
        if($producto->status=='si'){

            $producto->status='no';
            $producto->save();
            flash('Producto inhabilitado con exito. Debe tomar en cuenta que ya no estará disponible en el catalogo de DigitalMarket')->important()->success();

            return  redirect()->route('producto.index');
        }else{
            flash('Este producto ya se encuentra inhabilitado')->important()->warning();

            return  redirect()->route('producto.index');
           
        }
     
     

       
    }

    public function obtenerTienda($codigo){
        
        if(Tienda::where('codigo',$codigo)->first()){
            $tienda=Tienda::where('codigo',$codigo)->first();
            return $tienda;
        }else{
            return 'No hay registros de esta tienda';
                }
      
    }


   //CONROLADOR DE LA TIENDA

//filtar productos por categoria

    public function productoCategoria($slug){
        
        
        if(subCategoria::where('slug',$slug)->count()==0){
            abort(404);
        }else{

            $categoria=Categoria::where('estatus','A')->get();
        
        $subCategoria=subCategoria::where('slug',$slug)->with(['producto'=>function($q){
            $q->where('status','si');
        }])->first();
        
        $marca=Marca::where('status','A');
       
        
            return view('plantilla.tiendaContenido.filtroCategoria.subCategoria',compact('categoria','subCategoria','marca'));
        }

    }

    public function mainProductoCategoria($slug){
        
        if(Categoria::where('estatus','A')->where('slug',$slug)->count()==0){
            abort(404);
        }else{
            $categoria=Categoria::where('estatus','A')->get();
    
        $mainCategoria=Categoria::where('estatus','A')->where('slug',$slug)->with('subCategoria')->first();
        
            $marca=Marca::All();
       
            return view('plantilla.tiendaContenido.filtroCategoria.categoria',compact('subCategoria','marca','categoria','mainCategoria'));
        }
    }
    //fin de filtros por categoria

    //DETALLES DE PRODUCTO

    public function detalleProducto($slug){
        
        $categoria=Categoria::where('estatus','A')->get();

        $producto=Producto::where('status','si')->with('marca')->with('calificacion')->where('slug',$slug)->first();
        
        $producto->visitas=$producto->visitas+1;
        $producto->save();

        $relacionProducto=Producto::where('slug','!=',$slug)->where('subCategoria_id',$producto->subCategoria_id)->get();
        
        $miga="<a style='color:#333;' href='/'>Home</a> / <a style='color:#333;'href='/mainCategorias/".$producto->subCategoria->categoria->slug."'>".$producto->subCategoria->categoria->nombre."</a> / <a style='color:#333;'href='/categorias/".$producto->subCategoria->slug."'>".$producto->subCategoria->nombre."</a>";
        
        $marca=Marca::All();
       
        if(count($producto->calificacion)<=0){
            
            $promedio=0;
            $formatPromedio=0;
        }else{

            $sumaCalificacion=Calificacion::where('producto_id',$producto->id)->sum('calificacion');
            $promedio=$sumaCalificacion/count($producto->calificacion);
            $formatPromedio=number_format($promedio,0);
        }

        return view('plantilla.tiendaContenido.producto.detalle',compact('producto','categoria','relacionProducto','miga','marca','promedio','formatPromedio'));
    }

    //FIN DE DETALLES DE PRODUCTOS

    public function agregarCarrito(Request $request){
     
        $producto=Producto::where('id',$request->producto_id)->first();
     
        if(!empty($request['deseo'])&&$request['deseo']=='deseo'){
            if(empty(\Auth::check())){
                flash('Para agregar un producto a su lista de deseos debe autenticarse')->important()->warning();
                return \redirect()->back();
            }

            if($producto->tipoCliente=='combinacion'){
                if($request->combinacion_id==''){
                    flash('Debe seleccionar una combinación')->important()->warning();
                    return \redirect()->back();
                }
        
                $countDc=Deseo::where(['comprador_id'=>\Auth::user()->comprador->id,'producto_id'=>$request['producto_id'],'combinacion_id'=>$request['combinacion_id']])->count();

                if($countDc>0){
                    flash('Ya ha agregado este producto a la lista de deseos')->important()->waring();
                    return \redirect()->back();
                }else{

                    $deseo=new Deseo();
                    $deseo->producto_id=$request['producto_id'];
                    $deseo->precio=$request['precio'];
                    $deseo->cantidad=$request['cantidad'];
                    $deseo->combinacion_id=$request['combinacion_id'];
                    $deseo->comprador_id=\Auth::user()->comprador->id;
                 
                    $deseo->save();
                }

            }else{

                
                $countDc=Deseo::where(['comprador_id'=>\Auth::user()->comprador->id,'producto_id'=>$request['producto_id']])->count();

                if($countDc>0){

                    flash('Ya ha agregado este producto a la lista de deseos')->important()->waring();
                    return \redirect()->back();

                }else{

                    $deseo=new Deseo();
                    $deseo->producto_id=$request['producto_id'];
                    $deseo->precio=$request['precio'];
                    $deseo->cantidad=$request['cantidad'];
                    $deseo->comprador_id=\Auth::user()->comprador->id;
                 
                    $deseo->save();
                }


            }


            
           
            
            flash('Producto agregado a la lista deseo')->important()->success();
            return \redirect()->back();
        }

        
        if(!empty($request['carritoBoton'])&& $request['carritoBoton']=="agregar a carrito" ){


        }

        


        \Session::forget('montoCupon');
        \Session::forget('codigoCupon');
        
     
        if(!empty(\Auth::check())){
            $comprador_id=\Auth::user()->comprador->id;
        }

        

        if(!empty(\Session::get('session_id'))){
            $session_id=\Session::get('session_id');
        }else{
            $session_id=\Str::random(40);
            \Session::put('session_id',$session_id);
        }

        if($producto->tipoCliente=='comun'){
        
            //verificar si la cantidad estata disponible
            if($request->cantidad>$producto->cantidad){
                \flash('No esta disponible esta cantidad')->warning()->important();
                return redirect()->back();
            }


        if(!empty(\Auth::check())){
            $cantidadProducto=\DB::table('carritos')->where(['producto_id'=>$request['producto_id'],'comprador_id'=>$comprador_id])->count();
        }else{
            $cantidadProducto=\DB::table('carritos')->where(['producto_id'=>$request['producto_id'],'session_id'=>$session_id])->count();
        }
            
            if( $cantidadProducto>0){

                if(empty(\Auth::check())){
                    $carrito=Carrito::where(['producto_id'=>$request['producto_id'],'session_id'=>$session_id])->first();
                }else{
                    $carrito=Carrito::where(['producto_id'=>$request['producto_id'],'comprador_id'=>$comprador_id])->first();

                }

                
                if($request['cantidad']+$carrito->cantidad>$producto->cantidad){

                    \flash('No esta disponible esta cantidad')->warning()->important();
                    return redirect('/detalleProducto/'.$producto->slug);

                }else{

                    \DB::table('carritos')->where(['producto_id'=>$request['producto_id'],'session_id'=>$session_id])->increment('cantidad',$request['cantidad']);

                }

            }else{
                    
                    if(!empty(\Auth::check())){

                        \DB::table('carritos')->insert(['producto_id'=>$request['producto_id'],'precio'=>$request['precio'],'cantidad'=>$request['cantidad'],'comprador_id'=>$comprador_id,'session_id'=>$session_id]);
                    }else{
                       
                        \DB::table('carritos')->insert(['producto_id'=>$request['producto_id'],'precio'=>$request['precio'],'cantidad'=>$request['cantidad'],'session_id'=>$session_id]);

                    }

            
            }
        }else{
           
            if($request->combinacion_id==''){
                flash('Debe seleccionar una combinación')->important()->warning();
                return \redirect()->back();
            }

            $combinacion=Combinacion::where('id',$request['combinacion_id'])->first();
            
            if($request->cantidad>$combinacion->cantidad){
                \flash('No esta disponible esta cantidad')->warning()->important();
                return redirect()->back();
            }

            $cantidadProducto=\DB::table('carritos')->where(['producto_id'=>$request['producto_id'],'session_id'=>$session_id,'combinacion_id'=>$request['combinacion_id']])->count();
            
            if( $cantidadProducto>0){

                
                $carrito=Carrito::where(['producto_id'=>$request['producto_id'],'session_id'=>$session_id,'combinacion_id'=>$request['combinacion_id']])->first();
                
                if($request['cantidad']+$carrito->cantidad>$combinacion->cantidad){

                    \flash('No esta disponible esta cantidad')->warning()->important();
                    return redirect('/detalleProducto/'.$producto->slug);

                }else{

                    \DB::table('carritos')->where(['producto_id'=>$request['producto_id'],'session_id'=>$session_id,'combinacion_id'=>$request['combinacion_id']])->increment('cantidad',$request['cantidad']);

                }
            }else{
                

                if(!empty(\Auth::check())){

                    \DB::table('carritos')->insert(['producto_id'=>$request['producto_id'],'precio'=>$request['precio'],'cantidad'=>$request['cantidad'],'comprador_id'=>$comprador_id,'session_id'=>$session_id,'combinacion_id'=>$request['combinacion_id']]);

                }else{

                    \DB::table('carritos')->insert(['producto_id'=>$request['producto_id'],'precio'=>$request['precio'],'cantidad'=>$request['cantidad'],'session_id'=>$session_id,'combinacion_id'=>$request['combinacion_id']]);

                }
            
                
            }


        }

       
        return redirect()->route('carrito');


    } 

    public function carrito(){

       
        
        if(\Auth::check()){
            $comprador_id=\Auth::user()->comprador->id;
            $userCarrito=\DB::table('carritos')->where(['comprador_id'=>$comprador_id])->get();

            

        }else{
            $session_id=\Session::get('session_id');
            $userCarrito=\DB::table('carritos')->where(['session_id'=>$session_id])->get();
        }


        if(!empty(\Auth::check())){

            $descuentoTipoComprador=\Auth::user()->comprador->tipoComprador->porcentajeDescuento;
            if($descuentoTipoComprador>0){
               
                $totalCantidad=0;
                foreach($userCarrito as $item){
                    $totalCantidad=$totalCantidad+($item->precio*$item->cantidad);
                }
                $montoDescuentoTipoComrador=$totalCantidad*($descuentoTipoComprador/100);
        
                \Session::put('$montoDescuentoTipoComrador',$montoDescuentoTipoComrador);
            }


            foreach ($userCarrito as $item) {
             
                $productoCount=Producto::where('id',$item->producto_id)->where('status','no')->count();
 
                if($productoCount>0){
                 \DB::table('carritos')->where(['comprador_id'=>$comprador_id,'producto_id'=>$item->producto_id])->delete();
                 
                
                }else{
                    $producto=Producto::find($item->producto_id);
                }


                if($producto->tipoCliente=='combinacion'){
                    $combinacion=Combinacion::where('id',$item->combinacion_id)->where('status','I')->count();

                    if( $combinacion>0){
                        \DB::table('carritos')->where(['comprador_id'=>$comprador_id,'producto_id'=>$item->producto_id,'combinacion_id'=>$item->combinacion_id])->delete();
                    }

                }

                
            }
            
            $userCarrito=\DB::table('carritos')->where(['comprador_id'=>$comprador_id])->get();

            
        }else{


            foreach ($userCarrito as $item) {
                $productoCount=Producto::where('id',$item->producto_id)->where('status','no')->count();
 
                if($productoCount>0){
                    \DB::table('carritos')->where(['session_id'=>$session_id,'producto_id'=>$item->producto_id])->delete();
                    
                }else{
                    $producto=Producto::find($item->producto_id);
                }

                if($producto->tipoCliente=='combinacion'){
                    $combinacion=Combinacion::where('id',$item->combinacion_id)->where('status','I')->count();

                    if( $combinacion>0){
                        \DB::table('carritos')->where(['session_id'=>$session_id,'producto_id'=>$item->producto_id,'combinacion_id'=>$item->combinacion_id])->delete();
                    }

                }

                
            }
            
            $userCarrito=\DB::table('carritos')->where(['session_id'=>$session_id])->get();
        }


        return view('plantilla.tiendaContenido.producto.carrito',compact('userCarrito'));
    }

    public function eliminarProductoCarrito($id){
        \Session::forget('montoCupon');
        \Session::forget('codigoCupon');

        \DB::table('carritos')->where('id',$id)->delete();

        flash('Se ha eliminado el producto del carrito')->success()->important();
        return redirect()->route('carrito');
    }

    public function actualizarProductoCarrito($id=null,$cantidad=null){

        \Session::forget('montoCupon');
        \Session::forget('codigoCupon');

        $obtenerCarrito=\DB::table('carritos')->where('id',$id)->first();
        $obtenerProducto=Producto::where('id',$obtenerCarrito->producto_id)->first();

        $actualizarCantidad=$obtenerCarrito->cantidad+$cantidad;

        if($obtenerProducto->tipoCliente=='comun'){

            if($obtenerProducto->cantidad>=$actualizarCantidad){
    
                \DB::table('carritos')->where('id',$id)->increment('cantidad',$cantidad);
                return redirect()->route('carrito');
    
            }else{
                
                flash('Esta cantidad excede la existente en este producto')->warning()->important();
                return redirect()->route('carrito');
            }

        }else{

            $combinacion=Combinacion::where('id',$obtenerCarrito->combinacion_id)->first();

            if($combinacion->cantidad>=$actualizarCantidad){
    
                \DB::table('carritos')->where('id',$id)->increment('cantidad',$cantidad);
                return redirect()->route('carrito');
    
            }else{
                flash('Esta cantidad excede la existente en este producto')->warning()->important();
                return redirect()->route('carrito');
            }

        }

    }

    public function obtenerMetodoPagoNacional(){
        $metodoPago=MetodoPago::with('bancoMetodoPago')->where('tipoPago','nacional')->get();
        
        return $metodoPago;
    }
    public function obtenerMetodoPagoInternacional(){
        $metodoPago=MetodoPago::with('bancoMetodoPago')->where('tipoPago','internacional')->get();
        return $metodoPago;
    }

    public function checkout($montoTotal){
        
        if(empty(\Auth::check())){
            return redirect('/iniciar-sesion');
        }

        

        $direcciones=Direccion::where('comprador_id',\Auth::user()->comprador->id)->get();
        
        $session_id=\Session::get('session_id');
        $userCarrito=\DB::table('carritos')->where(['comprador_id'=>\Auth::user()->comprador->id])->get(); 

        if( count($userCarrito)<=0){
            flash('El carrito se encuentra vacío')->warning()->important();
            return redirect()->route('carrito');
        }
       
        $totalPeso=0;
        foreach($userCarrito as $carrito){
            $producto=Producto::where('id',$carrito->producto_id)->first();

            $totalPeso=$totalPeso + ($producto->peso*$carrito->cantidad);

            $carritoDelete=Carrito::where(['comprador_id'=>\Auth::user()->comprador->id,'producto_id'=>$carrito->producto_id])->first();

            if($producto->tipoCliente=='comun'){
               
                if($carrito->cantidad>$producto->cantidad){
                    $carritoDelete->delete();
                    flash('El producto que desea comprar no posee la cantidad que usted require')->warning()->important();
                return redirect()->route('carrito');
                }

            }else{

                $countCombinacion=Combinacion::where('id',$carrito->combinacion_id)->where('status','I')->count();
                
                if($countCombinacion>0){
                    $carritoDelete->delete();
                    flash('La combinación del producto ' . $producto->nombre . ' ya no se encuentra disponible.')->warning()->important();
                    return redirect()->route('carrito');
                }else{

                    $combinacion=Combinacion::where('id',$carrito->combinacion_id)->first();
                    if($carrito->cantidad>$combinacion->cantidad){
                        $carritoDelete->delete();
                        flash('El producto que desea comprar ya no posee la cantidad que usted require')->warning()->important();
                    return redirect()->route('carrito');
                    }
                }


            }

            
            if($producto->status=='no'){
              
               $carritoDelete->delete();
               flash('El producto que desea comprar ya no se encuentra activo')->warning()->important();
                return redirect()->route('carrito');
            }

        }
       
        $metodoPago=MetodoPago::All();

        $totalBs=$montoTotal;

        $envioFree=\Auth::user()->comprador->tipoComprador->envioGratis;

        

        return view('plantilla.tiendaContenido.checkout',compact('direcciones','userCarrito','metodoPago','totalBs','envioFree','totalPeso'));

    }
    
    public function obtenerMetodoEnvio($municipio){
       
        if($municipio=='Iribarren'){
            $metodoEnvio=MedioEnvio::where(['status'=>'A'])->get();
            return $metodoEnvio;
        }else{
            $metodoEnvio=MedioEnvio::where(['status'=>'A','dentroIribarren'=>'no'])->get();
            return $metodoEnvio;
        }

    }

    public function obtenerDireccion(){
        $comprador=\Auth::user()->comprador;
        $direccion=Direccion::where('comprador_id',$comprador->id)->get();
        return $direccion;
    }
    
    public function realizarPedido(Request $request){

        if($request->isMethod('post')){
            
            $metodoPago=json_decode($request['metodoPagos'],true);
            $metodoEnvio=json_decode($request['metodoEnvio'],true);
            $pedido=new Pedido();
            $d=count(Pedido::All())+1;
            $pedido->codigo='00000' . $d;
            $pedido->codigoCupon=$request->codigoCupon;
            $pedido->codigoCupon=$request->codigoCupon;

           
            $pedido->precioEnvio=floatval($request->envioGratis);
              
            $pedido->cantidadCupon=$request->cantidadCupon;
            $pedido->status='esperaTransferencia';
            $pedido->metodoEnvio_id=$metodoEnvio['id'];

            if(!empty(\Session::get('$montoDescuentoTipoComrador'))){
                $pedido->descuentoAdicional=\Session::get('$montoDescuentoTipoComrador');
            }

            $direccionEnvio=new DireccionPedido;
            
            $direccionComprador=Direccion::where('id',$request->direccionEnvio)->first();


            $direccionEnvio->nombre= $direccionComprador->nombre;
            $direccionEnvio->apellido= $direccionComprador->apellido;
            $direccionEnvio->direccionExacta= $direccionComprador->direccionExacta;
            $direccionEnvio->puntoReferencia= $direccionComprador->puntoReferencia;
            $direccionEnvio->primerTelefono= $direccionComprador->primerTelefono;
            $direccionEnvio->segundoTelefono= $direccionComprador->segundoTelefono;
            $direccionEnvio->observacion= $direccionComprador->observacion;
            $direccionEnvio->zona= $direccionComprador->zona->nombre;
            $direccionEnvio->parroquia= $direccionComprador->zona->parroquia->nombre;
            $direccionEnvio->municipio= $direccionComprador->zona->parroquia->municipio->nombre;
            $direccionEnvio->estado= $direccionComprador->zona->parroquia->municipio->estado->nombre;
            $direccionEnvio->save();

            

            $direccionFactura=new DireccionFactura;
            
            $direccionComprador=Direccion::where('id',$request->direccionFactura)->first();
            

            $direccionFactura->nombre= $direccionComprador->nombre;
            $direccionFactura->apellido= $direccionComprador->apellido;
            $direccionFactura->direccionExacta= $direccionComprador->direccionExacta;
            $direccionFactura->puntoReferencia= $direccionComprador->puntoReferencia;
            $direccionFactura->primerTelefono= $direccionComprador->primerTelefono;
            $direccionFactura->segundoTelefono= $direccionComprador->segundoTelefono;
            $direccionFactura->observacion= $direccionComprador->observacion;
            $direccionFactura->zona= $direccionComprador->zona->nombre;
            $direccionFactura->parroquia= $direccionComprador->zona->parroquia->nombre;
            $direccionFactura->municipio= $direccionComprador->zona->parroquia->municipio->nombre;
            $direccionFactura->estado= $direccionComprador->zona->parroquia->municipio->estado->nombre;
            $direccionFactura->save();


            $pedido->direccion_id= $direccionEnvio->id;
            $pedido->factura_id= $direccionFactura->id;
            $pedido->comprador_id=\Auth::user()->comprador->id;
            
            $pedido->save();


            for ($i=0; $i <count($metodoPago) ; $i++) {     
                $pedido->metodoPago()->attach($metodoPago[$i]['id'],['cantidad'=>$metodoPago[$i]['cantidad'],
                'status'=>'espera'
                ]);
            }

            $carritoProducto=\DB::table('carritos')->where(['comprador_id'=> $pedido->comprador_id])->get();
            for ($i=0; $i <count($carritoProducto) ; $i++) {     
                $pedido->producto()->attach($carritoProducto[$i]->producto_id,['combinacion_id'=>$carritoProducto[$i]->combinacion_id,'cantidadProducto'=>$carritoProducto[$i]->cantidad,
                'status'=>'esperaPago',
                'precioProducto'=>$carritoProducto[$i]->precio]);

                //disminuir stock del producto
                $obtenerStockProducto=Producto::where('id',$carritoProducto[$i]->producto_id)->first();

                $obtenerStockProducto->ventas=$obtenerStockProducto->ventas+1;
                $obtenerStockProducto->save();

                if($obtenerStockProducto->tipoCliente=='comun'){

                    $nuevoStock=$obtenerStockProducto->cantidad-$carritoProducto[$i]->cantidad;

                    Producto::where('id',$carritoProducto[$i]->producto_id)->update(['cantidad'=>$nuevoStock]);

                    //notificar stock minimo
                    $cantidadRestante=Producto::find($carritoProducto[$i]->producto_id);

                    if($cantidadRestante->cantidad<=$obtenerStockProducto->notificarStock){

                        $comment = 'productoStock'; 
                        $t=$obtenerStockProducto->tienda;
                        $t->notify(new pedidoNotification($comment,$obtenerStockProducto->id));

                    }

                }else{
                    $obtenerCombinacion=Combinacion::where('id',$carritoProducto[$i]->combinacion_id)->first();

                    $nuevoStockCom=$obtenerCombinacion->cantidad-$carritoProducto[$i]->cantidad;

                    $nuevoStock=$obtenerStockProducto->cantidad-$carritoProducto[$i]->cantidad;
                    
                    Producto::where('id',$carritoProducto[$i]->producto_id)->update(['cantidad'=>$nuevoStock]);

                    Combinacion::where('id',$carritoProducto[$i]->combinacion_id)->update(['cantidad'=>$nuevoStockCom]);

                }

            }

            \Session::put('pedido_id',$pedido->id);
            \Session::put('montoTotal',$request->precioFijoBs);  

            $pedido=Pedido::with('producto')->with(['metodoPago'=>function($q){
                $q->with('bancoMetodoPago');}])->with('medioEnvio')->where('id',$pedido->id)->first();
              
                


            $comprador=Comprador::with('tipoComprador')->find(\Auth::user()->comprador->id);
            $correo=\Auth::user()->email;
            $datosMensaje=[
                'correo'=>$correo,
                'comprador'=>$comprador,
                'nombre'=>$comprador->nombre,
                'detalleProducto'=>$pedido,
                'direccionFactura'=>$direccionFactura,
                'direccionEnvio'=>$direccionEnvio
            ];
 
            
           
            Mail::send('correos.pedido',$datosMensaje,function($mensaje) use($correo){
                $mensaje->to($correo)->subject('Pedido realizado - DigitalMarket');
            });

            \Session::forget('montoCupon');
            \Session::forget('codigoCupon');
            \Session::forget('$montoDescuentoTipoComrador');
            
            return redirect('/gracias');

        }

        
    }

    public function gracias(Request $request){

        $comprador_id=\Auth::user()->comprador->id;
        \DB::table('carritos')->where('comprador_id',$comprador_id)->delete(); 
        return view('plantilla.tiendaContenido.gracias');

    }

    public function buscarProducto(Request $request){

        /*$producto=Producto::where('nombre','like','%'.$request->nombre.'%')->orwhere('sku',$request->nombre)->where('status','si')->with('imagen')->paginate(12);
        $productoBuscado=$request->nombre;*/
        $busqueda=$request->nombre;
        $producto=Producto::where(function($query) use($busqueda){
            $query->where('nombre','like','%'.$busqueda.'%')
            ->orWhere('descripcionCorta','like','%'.$busqueda.'%')
            ->orWhere('especificaciones','like','%'.$busqueda.'%')
            ->where('status','si');
        })->paginate(6);
        
        $categoria=Categoria::with('subCategoria')->get();

        $marca=Marca::All();

        return view('plantilla.tiendaContenido.producto.listado',compact('producto','categoria','marca'));
    }   

    public function listaDeseo(){

        if(\Auth::check()){
            $comprador_id=\Auth::user()->comprador->id;
            $listaDeseo=Deseo::where(['comprador_id'=>$comprador_id])->get();   
            return view('plantilla.tiendaContenido.producto.listaDeseo',compact('listaDeseo'));

            



        }else{
            flash('Debe autenticarse para poder ver la lista de deseos')->warning()->important();
            return redirect()->back();
        }
    }

    public function eliminarListaDeseo($id){
        $deseo=Deseo::findOrFail($id);
        $deseo->delete();
        flash('Producto eliminado de la lista de deseo con exito')->success()->important();
        return redirect()->back();
    }

    public function productoMasa(){

    
        return view('plantilla.contenido.tienda.producto.importarProductos');

    }

    public function productoMasas(Request $request){

        $v=Validator::make($request->all(),[
            'file'=>'required'
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
        
        
        $file=$request->file('file');
        \Excel::import(new ProductosImport,$file);
        flash('Productos agregados con exito')->important()->success();
        return redirect()->route('tiendas.producto.masivo');

    }

    
    
}