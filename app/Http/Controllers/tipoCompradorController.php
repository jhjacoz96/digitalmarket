<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoComprador;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;


class tipoCompradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre=$request->get('nombre');
        $tipo=TipoComprador::with('comprador')->where('estatus',1)->where('nombre','like',"%$nombre%")->get();

        return view('plantilla.contenido.admin.tipoComprador.consultar',compact('tipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plantilla.contenido.admin.tipoComprador.crear');
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
            'nombre'=>'required|unique:tipo_compradors,nombre'

        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
      
        $tipo= new TipoComprador();
        $tipo->nombre=$request->nombre;
        $tipo->porcentajeDescuento=$request->descuento;
        
        if($request->envio){
            $tipo->envioGratis=true;
        }else{
            $tipo->envioGratis=false;
        }

        if($request->precio){
            $tipo->mostrarPrecio=true;
        }else{
            $tipo->mostrarPrecio=false;
        }

        if($request->activo){
            $tipo->estatus=true;
        }else{
            $tipo->estatus=false;
        }


        $tipo->save();

        flash('El tipo de comprador se ha agregado con exito')->important()->success();

        return \redirect()->route('tipoComprador.index');
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
        $tipo=TipoComprador::findOrFail($id);
        return view('plantilla.contenido.admin.tipoComprador.modificar',compact('tipo'));
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
            'nombre'=>'required|unique:tipo_compradors,nombre,'.$id
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
        $tipo=TipoComprador::findOrFail($id);
        $tipo->nombre=$request->nombre;
        $tipo->porcentajeDescuento=$request->descuento;
        
        if($request->envio){
            $tipo->envioGratis=true;
        }else{
            $tipo->envioGratis=false;
        }

        if($request->precio){
            $tipo->mostrarPrecio=true;
        }else{
            $tipo->mostrarPrecio=false;
        }

        if($request->activo){
            $tipo->estatus=true;
        }else{
            if($tipo->nombre=='Comprador'||$tipo->nombre=='comprador'){
                $tipo->estatus=true;
            }else{
                $tipo->estatus=false;
            }
        }



        $tipo->save();

        flash('El tipo de comprador se ha modificado con exito')->important()->success();

        return \redirect()->route('tipoComprador.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $tipo=TipoComprador::with('comprador')->with('cupon')->findOrFail($id);
        if(count($tipo->comprador)>0){
            flash('No puede eliminar este tipo de comprador ya que posee ' . count($tipo->comprador) . ' comprador(es) asociado(s)')->important()->warning();
            return redirect()->route('tipoComprador.index');
        }else if($tipo->nombre=='Comprador'||$tipo->nombre=='comprador'){
                flash('El tipo de cliente ' . $tipo->nombre . ' no se puede eliminar ya que es un tipo de cliente predeterminado')->important()->warning();
                return redirect()->route('tipoComprador.index');
            }else if(count($tipo->cupon)>0){
                flash('No puede eliminar este tipo de comprador ya que posee ' . count($tipo->cupon) . ' cupon(es) de descuento asociado(s)')->important()->warning();
                return redirect()->route('tipoComprador.index');
            }else{
                $tipo->delete();
                flash('Tipo de comprador eliminado con exito')->important()->success();
                 return redirect()->route('tipoComprador.index');
        }
        
    }
}
