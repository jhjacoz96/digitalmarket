<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comprador;
use App\Estado;
use App\Municipio;
use App\Parroquia;
use App\Zona;
use App\Direccion;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;

class direccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        $direccion=Direccion::All();
     
        return \view('plantilla.contenido.admin.comprador.direccion.consultar',compact('direccion'));
    }

    public function getComprador($correo){
       
            if(Comprador::where('correo',$correo)->first()){
                $comprador=Comprador::where('correo',$correo)->first();
                return $comprador;
            }else {
                return 'No hay registro de este comprador';
            }
        

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        if(\Auth::User()->rol_id==1){
            return view('plantilla.tiendaContenido.perfil.direccion.crear');
        }
        return view('plantilla.contenido.admin.comprador.direccion.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function getEstado(){
        $estado=Estado::All();
        return $estado;
     }

     public function getMunicipio($id){
        $municipio=Municipio::where('estado_id',$id)->get();
        return $municipio;
     }

     public function getParroquia($id){
        $parroquia=Parroquia::where('minicipio_id',$id)->get();
        return $parroquia;
     }
     public function getZona($id){
        $zona=Zona::where('parroquia_id',$id)->get();
        return $zona;
     }

    public function store(Request $request)
    {

        

        $v=Validator::make($request->all(),[
            'nombre'=>'required',
            'apellido'=>'required',
            
            'direccion'=>'required',
            'puntoReferencia'=>'required',
            'primerTelefono'=>'required|min:10',
            'segundoTelefono'=>'required|min:10',
            'zona_id'=>'required'

        ]);
           

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        

        $direccion=new Direccion();
        $direccion->nombre=$request->nombre;
        $direccion->apellido=$request->apellido;
        $direccion->direccionExacta=$request->direccion;
        $direccion->puntoReferencia=$request->puntoReferencia;
        $direccion->primerTelefono=$request->primerTelefono;
        $direccion->segundoTelefono=$request->segundoTelefono;
        $direccion->observacion=$request->descripcion;
        
        $direccion->zona_id=$request->zona_id;
        if(\Auth::user()->rol_id==3){
            $d=$request->correo;
            $comprador=Comprador::where('correo',$d)->first();
            $direccion->comprador_id=$comprador->id;

            $direccion->save();

            \flash('Direccion agregada con exito')->important()->success();
            
            return redirect()->route('direccion.index');
        }else{

            $direccion->comprador_id=\Auth::user()->comprador->id;

            $direccion->save();

            if($request->checkout=='si'){
                \flash('Direccion agregada con exito')->important()->success();
            
                return redirect('/checkout');
            }
            \flash('Direccion agregada con exito')->important()->success();
            
            return redirect('/comprador/cuenta');
        }
        
      
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
        $direccion=Direccion::findOrfail($id);
        if(\Auth::user()->rol_id==3){

            return view('plantilla.contenido.admin.comprador.direccion.modificar',compact('direccion'));
        }else{
            return view('plantilla.tiendaContenido.perfil.direccion.modificar',compact('direccion'));
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
            'nombre'=>'required',
            'apellido'=>'required',
            
            'direccion'=>'required',
            'puntoReferencia'=>'required',
            'primerTelefono'=>'required|min:10',
            'segundoTelefono'=>'required|min:10',
            'zona_id'=>'required'

        ]);
           
        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }


        $direccion=Direccion::findOrFail($id);
        $direccion->nombre=$request->nombre;
        $direccion->apellido=$request->apellido;
        $direccion->direccionExacta=$request->direccion;
        $direccion->puntoReferencia=$request->puntoReferencia;
        $direccion->primerTelefono=$request->primerTelefono;
        $direccion->segundoTelefono=$request->segundoTelefono;
        $direccion->observacion=$request->descripcion;
        
        $direccion->zona_id=$request->zona_id;
        if(\Auth::user()->rol_id==3){
            $d=$request->correo;
            $comprador=Comprador::where('correo',$d)->first();
            $direccion->comprador_id=$comprador->id;

            $direccion->save();

            \flash('Direccion actualizada con exito')->important()->success();
            
            return redirect()->route('direccion.index');
        }else{
            $direccion->comprador_id=\Auth::user()->comprador->id;

            $direccion->save();

            \flash('Direccion actualizada con exito')->important()->success();
            
            return redirect('/comprador/cuenta');
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
        $direccion=Direccion::findOrFail($id);
        $direccion->delete();
        
        if(\Auth::user()->rol_id==3){
        \flash('Se ha eliminado esta dirección con exito')->important()->success();
        return redirect()->route('direccion.index');
        }else{
            \flash('Se ha eliminado esta dirección con exito')->important()->success();
        return redirect('/comprador/cuenta');
        }
    }
}
