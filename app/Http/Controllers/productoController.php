<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;
use App\SubCategoria;
use App\Combinacion;
use App\Atributo;
use App\GrupoAtributo;
use App\Imagen;
use Illuminate\Support\Facades\File;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;


class productoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index(Request $request)
    {
    
      $nombre=$request->get('nombre');
        
        $producto=Producto::with('imagen','subCategoria')->where('nombre','like',"%$nombre%")->paginate(2);
        
        return view('plantilla.contenido.admin.producto.consultar',compact('producto'));
    }

    
    

    public function Categoria(){
        $categoria=Categoria::orderBy('nombre')->get();
        return $categoria;
    }

    public function create()
    {
        $categoria=Categoria::orderBy('nombre')->get();
        
        return \view('plantilla.contenido.admin.producto.crear',compact('categoria'));
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
            'imagenes.*'=>'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            
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


        $producto= new Producto();

        $producto->nombre=$request->nombre;
        $producto->slug=$request->slug;
        $producto->cantidad=$request->cantidad;
        $producto->subCategoria_id=$request->subCategoria_id;
        $producto->precioAnterior=$request->precioAnterior;
        $producto->precioActual=$request->precioActual;
        $producto->porcentajeDescuento=$request->porcentajeDescuento;
        $producto->descripcionCorta=$request->descripcionCorta;
        $producto->descripcionLarga=$request->descripcionLarga;
        $producto->especificaciones=$request->especificaciones;
        $producto->datosInteres=$request->datosInteres;
        $producto->status=$request->status;

        //$Producto->tipoProducto=$request->tipoProd;



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

       \flash('Producto creado con exito')->success()->important();

        return \redirect()->route('producto.index');
    }

    public function getSubCategoria(Request $request){
        if($request->ajax()){
            
            $subCategorias=SubCategoria::where('categoria_id',$request->categoria_id)->get();
            foreach ($subCategorias as $subCategoria) {
                $subCategoriaArray[$subCategoria->id]=$subCategoria->nombre;
            }
            return response()->json($subCategoriaArray);
        }
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
        

        return view('plantilla.contenido.admin.producto.modificar',compact('producto','categoria'));
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


        $producto=Producto::findOrFail($id);

        $producto->nombre=$request->nombre;
        $producto->slug=$request->slug;
        $producto->cantidad=$request->cantidad;
        $producto->subCategoria_id=$request->subCategoria_id;
        $producto->precioAnterior=$request->precioAnterior;
        $producto->precioActual=$request->precioActual;
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

       \flash('Producto actualizado con exito')->success()->important();

        return \redirect()->route('producto.edit',$producto->slug);

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
        
        foreach ($producto->imagen as $imagen) {
           
            $archivo=substr($imagen->url,1);
            File::delete($archivo);
            $imagen->delete();
        }

        $producto->delete();

        flash('producto eliminado con exito')->important()->success();

        return  redirect()->route('producto.index');
    }
}
