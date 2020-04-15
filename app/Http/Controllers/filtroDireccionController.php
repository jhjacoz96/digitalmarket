<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use App\Estado;
use App\Parroquia;
use App\Municipio;
use App\Http\requests\requestEstado;


class filtroDireccionController extends Controller
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
        $estado=Estado::all();

        return \view('plantilla.contenido.admin.filtroDireccion.crear',compact('estado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'estado'=>'min:3|required|unique:estados,nombre',
            'municipio'=>'unique:municipios,nombre',
            'municipio.*'=>'distinct|unique:municipios,nombre'
        ]);

        
        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
        
       $estado=new Estado();
        $estado->nombre=$request->estado;
        $estado->save();
        
        
        if(coun($request->municipio)>0){
            for ($i=0; $i < count($request->municipio) ; $i++) { 
                
                $municipio=new Municipio();
                $municipio->nombre=$request->municipio[$i];
                $municipio->estado_id=$estado->id;
                $municipio->save();
            }
        }  

        \flash('Estado agregado con exito')->important()->success();

        return \redirect()->route('filtroDireccion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estados=Estado::with('municipio')->findOrFail($id);
        return view('plantilla.contenido.admin.filtroDireccion.modificarEstado',compact('estados'));
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
            'estado'=>'min:3|required|unique:estados,nombre,'.$id,
            'municipio'=>'unique:municipios,nombre',
            'municipio.*'=>'distinct|unique:municipios,nombre'
        ]);

        
        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        $estado=Estado::findOrFail($id);
        $estado->nombre=$request->estado;
        $estado->save();
        
        if($request->municipio!=null){
            for ($i=0; $i < count($request->municipio) ; $i++) { 
                
                $municipio=new Municipio();
                $municipio->nombre=$request->municipio[$i];
                $municipio->estado_id=$estado->id;
                $municipio->save();
            }

            \flash('Estado modificado con exito')->important()->success();

        return \redirect()->route('filtroDireccion.index');

        } else{


            \flash('Estado modificado con exito')->important()->success();
    
            return \redirect()->route('filtroDireccion.index');
        }   


    }

    public function updateMunicipio(Request $request, $id)
    {
        
        $v=Validator::make($request->all(),[
            'municipio'=>'min:3|required|unique:municipios,nombre,'.$id,
            'parroquia'=>'unique:parroquias,nombre',
            'parroquia.*'=>'distinct|unique:parroquias,nombre'
        ]);
        
        
        
        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        

        $municipio=Municipio::findOrFail($id);
        $municipio->nombre=$request->municipio;
        $municipio->save();
        
        if($request->parroquia==null){

            \flash('Municipio modificado con exito')->important()->success();

            return \redirect()->route('filtroDireccion.municipio.edit',$municipio);

        } else{
                for ($i=0; $i < count($request->parroquia) ; $i++) { 
                    
                    $parroquia=new Parroquia();
                    $parroquia->nombre=$request->parroquia[$i];
                    $parroquia->minicipio_id=$municipio->id;
                    $parroquia->save();
    
                    \flash('Municipio modificado con exito')->important()->success();
    
                    return \redirect()->route('filtroDireccion.municipio.edit',$municipio);
                }

            

        }   

       

    }

    public function updateParroquia(Request $request, $id)
    {
        
        $v=Validator::make($request->all(),[
            'parroquia'=>'min:3|required|unique:parroquias,nombre,'.$id
            
        ]);
        
        
        
        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        

        $parroquia=Parroquia::findOrFail($id);
        $municipio=$parroquia->municipio;
        
        $parroquia->nombre=$request->parroquia;
        $parroquia->save();
        
        

            \flash('Parroquia  modificada con exito')->important()->success();

            return \redirect()->route('filtroDireccion.municipio.edit',$municipio);
 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function eliminarEstado($id){
        
        
        $estado=Estado::findOrFail($id);
        if(count($estado->municipio)!=null ){

            \flash('No puede eliminar este estado, ya que posee ' . count($estado->municipio) . ' municipios  ')->important()->warning();
            return  \redirect()->route('filtroDireccion.index');

        }else{

            $estado->delete();
            \flash('Estado eliminado con exito')->important()->success();
            return  \redirect()->route('filtroDireccion.index');
        }

    }

    public function eliminarMunicipio($id){

        $municipio=Municipio::findOrFail($id);
        
        $estado=$municipio->estado;
        
        if(count($municipio->parroquia)!=null ){

            \flash('No puede eliminar este municipio, ya que posee ' . count($municipio->parroquia) . ' parroquias ')->important()->warning();
            return  \redirect()->route('filtroDireccion.edit',$estado);
        }else{

            $municipio->delete();
            \flash('Municipio eliminado con exito')->important()->success();
            return  \redirect()->route('filtroDireccion.edit',$estado);
        }
     
    }

    public function eliminarParroquia($id){


        $parroquia=Parroquia::findOrFail($id);
        $municipio=$parroquia->municipio;
        if(count())
        $parroquia->delete();
        \flash('Parroquia eliminado con exito')->important()->success();
        return  \redirect()->route('filtroDireccion.municipio.edit',$municipio);
     
    }

    public function editMunicipio($id){
        
        $municipio=Municipio::with('parroquia')->findOrFail($id);

        return view('plantilla.contenido.admin.filtroDireccion.modificarMunicipio',compact('municipio'));
        
    }

    public function editParroquia($id){
        
        $parroquia=Parroquia::findOrFail($id);
        
        return view('plantilla.contenido.admin.filtroDireccion.modificarParroquia',compact('parroquia'));
        
    }

    public function destroy($id)
    {
        
    }
}
