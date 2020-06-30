<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use App\BancoMetodoPago;
use App\MetodoPago;

class metodoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre=$request->get('nombre');
        
        $pago=metodoPago::where('nombre','like',"%$nombre%")->get();
        
        return view('plantilla.contenido.admin.metodoPago.consultar',compact('pago'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
        $banco=BancoMetodoPago::All();
        return view('plantilla.contenido.admin.metodoPago.crear',compact('banco'));
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
            'nombre'=>'required|unique:metodoPagos,nombre',
            'tipoMetodo'=>'required',
            'moneda'=>'required'
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        $metodo=new MetodoPago();
        $metodo->nombre=$request->nombre;
        $metodo->descripcion=$request->descripcion;
        $metodo->tipoPago=$request->tipoMetodo;
        $metodo->moneda=$request->moneda;
        $metodo->telefono=$request->telefono;
        $metodo->correo=$request->correo;
        $metodo->bancoMetodoPago_id=$request->bancoMetodoPago;
        $metodo->save();
        \flash('Medio de pago agregado con exito')->important()->success();
        return \redirect()->route('metodoPago.index');
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
        $cuenta=BancoMetodoPago::All();
        $banco=MetodoPago::findOrFail($id);
        return view('plantilla.contenido.admin.metodoPago.modificar',compact('cuenta'),compact('banco'));
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
        $bancos=MetodoPago::findOrFail($id);
        $bancos->nombre=$request->nombre;
        $bancos->descripcion=$request->descripcion;
        $bancos->tipoPago=$request->tipoMetodo;
        $bancos->moneda=$request->moneda;
        $bancos->telefono=$request->telefono;
        $bancos->correo=$request->correo;
        $bancos->bancoMetodoPago_id=$request->bancoMetodoPago;
        $bancos->save();
        \flash('Medio de pago modificado con exito')->important()->success();
        return \redirect()->route('metodoPago.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $bancos=MetodoPago::findOrFail($id);
        
        $pedido=count($bancos->pedido);
        
        if($pedido>0){
            \flash('No es posible eliminar este medio de envío ya que posee pedidos asociado')->important()->warning();
        return \redirect()->route('metodoPago.index');
        }else{

            \flash('Medio de pago eliminado con exito')->important()->success();
            return \redirect()->route('metodoPago.index');
        }

    }
}
