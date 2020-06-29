<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;
use App\Imagen;
use App\Producto;
use App\Categoria;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
class marcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $marca=marca::with('producto','imagen')->get();
        return view('plantilla.contenido.admin.marca.consultar',compact('marca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plantilla.contenido.admin.marca.crear');
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
            'nombre'=>'required',
            'descripcion'=>'required'
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        $marca=new Marca();
        $marca->nombre=$request->nombre;
        $marca->descripcion=$request->descripcion;

      
        if($request->status){

            $marca->status='A';
        }else{
            $marca->status='I';
        }

        $marca->save();

            if($request->file('imagen')){
     
                $imagen=$request->file('imagen');
               
                $nombre=time().'_'.$imagen->getClientOriginalName();
                $ruta=public_path().'/imagenes/marcas';
                $imagen->move($ruta , $nombre);
     
                $urlImagen['url']='/imagenes/marcas/'.$nombre;
                
                $marca->imagen()->create($urlImagen);
            }


            \flash('Marca agregado con exito')->important()->success();

            return \redirect()->route('marca.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto=Producto::where(['marca_id'=>$id])->paginate(12);
        $marca=Marca::All();
        $categoria=Categoria::with('subCategoria')->get();
        return view('plantilla.tiendaContenido.producto.listado',compact('producto','marca','categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marca=Marca::findOrFail($id);
        return \view('plantilla.contenido.admin.marca.modificar',compact('marca'));
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
            'nombre'=>'required',
            'descripcion'=>'required'
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        $marca=Marca::findOrFail($id);

        $marca->nombre=$request->nombre;
        $marca->descripcion=$request->descripcion;
        

        if($request->status){
            $marca->status='A';
        }else{
            $marca->status='I';
        }

        $marca->save();

        $imagen=$request->file('imagen');
        if($imagen!=null){
         
            $nombre=time().'_'.$imagen->getClientOriginalName();
            $ruta=public_path().'/imagenes/marcas';
            $imagen->move($ruta , $nombre);
    
            $urlImagen['url']='/imagenes/marcas/'.$nombre;
            $marca->imagen()->create($urlImagen);
        }   
       
       


        \flash('Marca actualizada con exito')->important()->success();

        return \redirect()->route('marca.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marca=Marca::findOrFail($id);
        $count=$marca->producto;
        if(count($count)>0){
            \flash('No puede eliminar esta marca ya que tiene productos asocados')->important()->warning();

        return \redirect()->route('marca.index');
        }else{

            $marca->delete();
            \flash('marca eliminado con exito')->important()->success();
            return \redirect()->route('marca.index');
        }

       
    }
}
