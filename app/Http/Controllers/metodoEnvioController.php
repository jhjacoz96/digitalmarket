<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use App\MedioEnvio;
use App\Direccion;
use App\Zona;
use App\Parroquia;
use App\Municipio;
use App\Estado;

class metodoEnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    
        $envio=MedioEnvio::All();
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

        if($request->alcance=='iribarren'){
            $envio->dentroIribarren='si';
        }else{
            $envio->dentroIribarren='no';
        }

        if($request->activo){
            $envio->status='A';
        }else{
            $envio->status='I';
        }

        if($request->envioGratis){
            $envio->envioGratis='A';
            $envio['0kgA30kg']=0;
            $envio['31kgA50kg']=0;
            $envio['50kgA100kg']=0;
            $envio['101kgA200kg']=0;
            $envio['mayorA201kg']=0;
        }else{

           /* if($request->montoMinimo){
                $envio['envioGratisApartir']=$request->montoMinimo;
            }*/
            if($request->envioGratisMonto){
                $envio['envioGratisApartir']=$request->montoMinimo;
            }else{
                $envio['envioGratisApartir']=0;
            }

            $envio->envioGratis='I';
            $envio['0kgA30kg']=$request->precio0kg30kg;
            $envio['31kgA50kg']=$request->precio31kg50kg;
            $envio['50kgA100kg']=$request->precio51kg100kg;
            $envio['101kgA200kg']=$request->precio101kg200kg;
            $envio['mayorA201kg']=$request->precio201kg;
        }

       
        $envio->save();

        \flash('Metodo de envio agregado con exito')->important()->success();
        return \redirect()->route('metodoEnvio.index');
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
        $envio->tiempoEntrega=$request->tiempoEntrega;

        if($request->alcance=='iribarren'){
            $envio->dentroIribarren='si';
        }else{
            $envio->dentroIribarren='no';
        }

        if($request->activo){
            $envio->status='A';
        }else{
            $envio->status='I';
        }

        if($request->envioGratis){
            $envio->envioGratis='A';
            $envio['0kgA30kg']=0;
            $envio['31kgA50kg']=0;
            $envio['50kgA100kg']=0;
            $envio['101kgA200kg']=0;
            $envio['mayorA201kg']=0;
        }else{

            if($request->envioGratisMonto){
                $envio['envioGratisApartir']=$request->montoMinimo;
            }else{
                $envio['envioGratisApartir']=0;
            }

            $envio->envioGratis='I';
            $envio['0kgA30kg']=$request->precio0kg30kg;
            $envio['31kgA50kg']=$request->precio31kg50kg;
            $envio['50kgA100kg']=$request->precio51kg100kg;
            $envio['101kgA200kg']=$request->precio101kg200kg;
            $envio['mayorA201kg']=$request->precio201kg;
        }

       
        $envio->save();

        \flash('Medio de envio actualizado con exito')->important()->success();
        return \redirect()->route('metodoEnvio.index');
    }

   
    public function destroy($id)
    {
        $envio=MedioEnvio::findOrfail($id);
        $pedidos=$envio->pedido;
        if(count($pedidos)<=0){
         
            $envio->delete();
            \flash('Medio de envio eliminado con exito')->important()->success();
            return \redirect()->route('metodoEnvio.index');
        }else{
    
            \flash('No puede eliminar este medio de envio, ya que posee pedidos asociados')->important()->warning();
            return \redirect()->route('metodoEnvio.index');
        
        }
    }


    public function rangoEnvio($id){
        
        $direccion=Direccion::find($id);
        $municipio=$direccion->zona->parroquia->municipio;
        return $municipio;

    }

}
