<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\SubCategoria;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;

class subCategoriaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($categoria)
    {
        
    }
    public function traer($categoria)
    {
       $categoria=Categoria::findOrFail($categoria);
        return view('plantilla.contenido.admin.categorias.crearSub',compact('categoria'));
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
            'nombre'=>'min:2|required|unique:sub_categorias,nombre',
            'slug'=>'min:2|required|unique:sub_categorias,slug',
           
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

       
        $subCategoria=new SubCategoria();
        $subCategoria->nombre=$request->nombre;
        $subCategoria->slug=$request->slug;
        $subCategoria->descripcion=$request->descripcion;
        $subCategoria->categoria_id=$request->categoria;
    
        $categoria=Categoria::where('id',$request->categoria)->first();

        

        $subCategoria->save();
       

        \flash('Se ha agregado la sub categoria ' . $subCategoria->nombre . ' a la categoria ' . $categoria->nombre . ' con exito')->success()->important();

        return \redirect()->route('traerCategoria.traer',compact('categoria'));
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

        if(SubCategoria::where('slug',$slug)->first()){
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
    public function edit($id)
    {
         $subCategoria=SubCategoria::findOrFail($id);
         $editar='si';

         return view('plantilla.contenido.admin.categorias.modificarSub',compact('subCategoria','editar'));

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
            'nombre'=>'min:2|required|unique:sub_categorias,nombre,'.$id,
            'slug'=>'min:2|required|unique:sub_categorias,slug,'.$id
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        $subCategoria=SubCategoria::findOrFail($id);
        $subCategoria->nombre=$request->nombre;
        $subCategoria->slug=$request->slug;
        $subCategoria->descripcion=$request->descripcion;

        $categoria=Categoria::where('id',$subCategoria->categoria_id)->first();

        $subCategoria->save();
        \flash('La sub categoria ' . $subCategoria->nombre . ' ha sido actualizada con éxito')->success()->important();
        return redirect()->route('categoria.edit',$categoria->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $subCategoria=SubCategoria::findOrFail($id);
       if( count($subCategoria->producto)!=0){
        flash('No es posible eliminar esta sub categoria ya que posee ' . count($subCategoria->producto) . ' producto(s)')->warning()->important();
        return redirect()->route('categoria.edit',$subCategoria->categoria->slug);
       }else{
           $categoria=Categoria::where('id',$subCategoria->categoria_id)->first();
           $subCategoria->delete();
           flash('Sub categoria eliminada con exito')->success()->important();
           return redirect()->route('categoria.edit',$categoria->slug);
       }
    }
}
