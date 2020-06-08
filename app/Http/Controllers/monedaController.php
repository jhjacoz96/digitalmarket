<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Divisa;
use Illuminate\Support\Facades\Validator;
class monedaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $moneda=Divisa::All();
        return view('plantilla.contenido.admin.moneda.consultar',compact('moneda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plantilla.contenido.admin.moneda.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $moneda= new Divisa();
        $moneda->codigo=$request->codigo;
        $moneda->cambio=$request->cambio;
        if($request->status){
            $moneda->status='A';
        }else{
            $moneda->status='I';
        }
        $moneda->save();
        flash('Moneda agregada con exito')->success()->important();
        return redirect()->route('moneda.index');

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
        $moneda=Divisa::findOrfail($id);
        return view('plantilla.contenido.admin.moneda.modificar',compact('moneda'));
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
        $moneda=Divisa::findOrfail($id);
        $moneda->codigo=$request->codigo;
        $moneda->cambio=$request->cambio;
        if($request->status){
            $moneda->status='A';
        }else{
            $moneda->status='I';
        }
        $moneda->save();
        flash('Moneda actualiada con exito')->success()->important();
        return redirect()->route('moneda.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $moneda=Divisa::findOrfail($id);
        $moneda->delete();
        flash('Moneda eliminada con exito')->success()->important();
        return redirect()->route('moneda.index');
    }
}
