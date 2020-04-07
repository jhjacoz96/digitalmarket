<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;
use App\SubCategoria;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;


class productoController extends Controller
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
    public function index(Request $request)
    {
        $nombre=$request->get('nombre');
        
        $producto=Producto::where('nombre','like',"%$nombre%")->paginate(2);

        return view('plantilla.contenido.admin.producto.consultar',compact('producto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
