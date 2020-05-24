<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use App\MedioEnvio;

class metodoEnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre=$request->get('nombre');
    
        $envio=MedioEnvio::where('nombre','like',"%$nombre%")->paginate(2);
        return \view('plantilla.contenido.admin.metodoEnvio.consultar',compact('envio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plantilla.contenido.admin.metodoEnvio.crear');
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
            'tiempoEntrega'=>'required'
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        $envio=new MedioEnvio();

        $envio->nombre=$request->nombre;
       
        $envio->tiempoEntrega=$request->tiempoEntrega;

        if($request->activo){
            $envio->status='A';
        }else{
            $envio->status='I';
        }

        if($request->envioGratis){
            $envio->envioGratis='A';
            $envio->precioEnvio=0;
        }else{
            $envio->envioGratis='I';
            $envio->precioEnvio=$request->precioEnvio;
        }
       
        $envio->save();

        \flash('Metodo de envio agregado con exito')->important()->warning();
        return \redirect()->route('metodoEnvio.create');
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
        $envio=MedioEnvio::findOrFail($id);
   
        return \view('plantilla.contenido.admin.metodoEnvio.modificar',compact('envio'));
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
            'tiempoEntrega'=>'required'
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        $envio=MedioEnvio::findOrFail($id);

        $envio->nombre=$request->nombre;
        $envio->precioEnvio=$request->precioEnvio;
        $envio->tiempoEntrega=$request->tiempoEntrega;

        if($request->activo){
            $envio->status='A';
        }else{
            $envio->status='I';
        }

        if($request->envioGratis){
            $envio->envioGratis='A';
            $envio->precioEnvio=0;
        }else{
            $envio->envioGratis='I';
            $envio->precioEnvio=$request->precioEnvio;
        }
       
        $envio->save();

        \flash('Metodo de envio actualizado con exito')->important()->success();
        return \redirect()->route('metodoEnvio.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $envio=MedioEnvio::findOrfail($id);
        $envio->delete();
        \flash('Metodo de envio eliminado con exito')->important()->success();
        return \redirect()->route('metodoEnvio.index');
    }
}
