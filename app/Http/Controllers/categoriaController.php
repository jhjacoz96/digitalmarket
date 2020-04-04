<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class categoriaController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre=$request->get('nombre');
        
        $categoria=Categoria::where('nombre','like',"%$nombre%")->orderBy('nombre')->paginate(5);
        return \view('plantilla.contenido.admin.categorias.consultar',\compact('categoria'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plantilla.contenido.admin.categorias.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $categoria=new Categoria();
        $categoria->nombre=$request->nombre;
        $categoria->slug=$request->slug;
        $categoria->tipoLinea=$request->tipoLinea;
        $categoria->descripcion=$request->descripcion;
        $categoria->save();

        \flash('Categoria creada con exito')->success()->important();

        return  redirect()->route('categoria.index');
       //return Categoria::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        if(Categoria::where('slug',$slug)->first()){
            return 'slug existe';
        }
        else{
            return 'Slug disponible';
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categoria=Categoria::where('slug',$slug)->firstOrFail();
        $editar='si';

        return view('plantilla.contenido.admin.categorias.modificar',compact('categoria','editar'));
        
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
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre=$request->nombre;
        $categoria->slug=$request->slug;
        $categoria->tipoLinea=$request->tipoLinea;
        $categoria->descripcion=$request->descripcion;
        $categoria->save();
        \flash('Categoria actualizada con éxito')->success()->important();
        return redirect()->route('categoria.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->delete();
        flash('Categoria eliminada con exito')->success()->important();
        return redirect()->route('categoria.index');
    }
}
