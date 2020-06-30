<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use App\BancoMetodoPago;
use App\MetodoPago;

class bancoMetodoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre=$request->get('nombre');
    
        $banco=BancoMetodoPago::where('nombreBanco','like',"%$nombre%")->get();

        return view('plantilla.contenido.admin.metodoPago.bancoMetodoPago.consultar',compact('banco'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plantilla.contenido.admin.metodoPago.bancoMetodoPago.crear');
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
            'nombreBanco'=>'required|unique:banco_metodo_pagos,nombreBanco',
            'detalleCuenta'=>'required|min:15|max:20|unique:banco_metodo_pagos,detalleCuenta',
            'documentoIdentidad'=>'max:8'
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
        $banco=new BancoMetodoPago();
        $banco->nombreBanco=$request->nombreBanco;
        $banco->detalleCuenta=$request->detalleCuenta;
        $banco->tipoDocumento=$request->tipo;
        $banco->documentoIdentidad=$request->documentoIdentidad;
        $banco->titular=$request->titularCuenta;
        $banco->tipoCuenta=$request->tipoCuenta;
        $banco->save();



        \flash('Banco agregado con exito')->important()->success();
            return  \redirect()->route('bancoMetodoPago.index');
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
        $banco=BancoMetodoPago::findOrFail($id);
        return view('plantilla.contenido.admin.metodoPago.bancoMetodoPago.modificar',compact('banco'));
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
            'nombreBanco'=>'required|unique:banco_metodo_pagos,nombreBanco,'.$id,            'detalleCuenta'=>'required|min:15|max:20',
            'documentoIdentidad'=>'max:8'
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
        
        $banco=BancoMetodoPago::findOrFail($id);
        $banco->nombreBanco=$request->nombreBanco;
        $banco->detalleCuenta=$request->detalleCuenta;
        $banco->tipoDocumento=$request->tipo;
        $banco->documentoIdentidad=$request->documentoIdentidad;
        $banco->titular=$request->titularCuenta;
        $banco->tipoCuenta=$request->tipoCuenta;
        $banco->save();

        \flash('Banco actualizado con exito')->important()->success();
            return  \redirect()->route('bancoMetodoPago.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banco=BancoMetodoPago::findOrFail($id);

        $metodoPago=MetodoPago::where('bancoMetodoPago_id',$banco->id)->first();
        if($metodoPago==null){

            $banco->delete();
            \flash('Banco eliminado con exito')->important()->success();
                return  \redirect()->route('bancoMetodoPago.index');
        }else{
            \flash('No puede eliminiar este banco ya que esta asociado a un medio de pago')->important()->warning();
            return  \redirect()->route('bancoMetodoPago.index');
        }
    }
}
