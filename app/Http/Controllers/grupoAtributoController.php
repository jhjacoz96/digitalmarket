<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use App\GrupoAtributo;
use App\Atributo;

class grupoAtributoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre=$request->get('nombre');
        
        $grupoAtributo=GrupoAtributo::where('nombre','like',"%$nombre%")->paginate(5);
        return view('plantilla.contenido.admin.grupoAtributo.consultar',compact('grupoAtributo'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('plantilla.contenido.admin.grupoAtributo.crear');
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
            'grupo'=>'required'
            /*,'atributo'=>'unique:atributos,nombre',
            'atributo.*'=>'distinct|unique:atributos,nombre'*/
        ]);

        
        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
        
       $grupoAtributo=new GrupoAtributo();
        $grupoAtributo->nombre=$request->grupo;
        $grupoAtributo->save();
        
        
        if(count($request->atributo)>0){
            for ($i=0; $i < count($request->atributo) ; $i++) { 
                
                $atributo=new Atributo();
                $atributo->nombre=$request->atributo[$i];
                $atributo->grupoAtributo_id=$grupoAtributo->id;
                $atributo->save();
            }

    
        }


        \flash('Grupo agregado con exito')->important()->success();

        return \redirect()->route('grupoAtributo.index');

    }    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupoAtributo=GrupoAtributo::with('atributo')->findOrFail($id);
        return view('plantilla.contenido.admin.grupoAtributo.modificar',compact('grupoAtributo'));
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
            'grupo'=>'required'
            /*,'atributo'=>'unique:atributos,nombre',
            'atributo.*'=>'distinct|unique:atributos,nombre'*/
        ]);

        
        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
        
       $grupoAtributo=GrupoAtributo::findOrFail($id);
        $grupoAtributo->nombre=$request->grupo;
        $grupoAtributo->save();
        
        
        if(count($request->atributo)>0){
            for ($i=0; $i < count($request->atributo) ; $i++) { 
                
                $atributo=new Atributo();
                $atributo->nombre=$request->atributo[$i];
                $atributo->grupoAtributo_id=$grupoAtributo->id;
                $atributo->save();
            }

    
        }


        \flash('Grupo modificado con exito')->important()->success();

        return \redirect()->route('grupoAtributo.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function eliminarAtributo($id){
        $atributo=Atributo::findOrFail($id);
        $grupo=$atributo->grupoAtributo->id;
        $atributo->delete();

        \flash('atributo eliminado con exito')->important()->success();

        return \redirect()->route('grupoAtributo.edit',$grupo);

    }

    public function destroy($id)
    {
        $grupoAtributo=GrupoAtributo::findOrFail($id);
        $grupoAtributo->delete();
        
        \flash('Grupo eliminado con exito')->important()->success();

        return \redirect()->route('grupoAtributo.index');

    }
}
