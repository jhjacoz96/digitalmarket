<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use \App\Cupon;

class cuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $codigo=$request->get('codigoCupon');
              
       
        $cupon=Cupon::where('codigoCupon','like',"%$codigo%")->get();
        return view('plantilla.contenido.admin.cupon.consultar',compact('cupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plantilla.contenido.admin.cupon.crear');
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
            'codigo'=>'required|unique:cupons,codigoCupon',
            'cantidad'=>'required',
            'tipoCupon'=>'required',
            'fechaExpiracion'=>'required'
            
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
    

        $cupon=new Cupon();
        $cupon->codigoCupon=$request['codigo'];
        $cupon->cantidad=$request['cantidad'];
        $cupon->tipoCupon=$request['tipoCupon'];
        $cupon->fechaExpiracion=$request['fechaExpiracion'];
        if($request['estatus']){
            $cupon->estatus='A';
        }else{
            $cupon->estatus='I';
        }
          
        $cupon->save();

       

        flash('Cupón agregado con exito')->success()->important();
        return $cupon;
         return redirect()->route('cupon.index');

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
        $cupon=Cupon::findOrFail($id);
        return view('plantilla.contenido.admin.cupon.modificar',compact('cupon'));
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
                'codigo'=>'required|unique:cupons,codigoCupon,'.$id,                'cantidad'=>'required',
                'tipoCupon'=>'required',
                'fechaExpiracion'=>'required'
                
            ]);
    
            if ($v->fails()) {
                return \redirect()->back()->withInput()->withErrors($v->errors());
            }
        
    
            $cupon=Cupon::findOrFail($id);
            $cupon->codigoCupon=$request['codigo'];
            $cupon->cantidad=$request['cantidad'];
            $cupon->tipoCupon=$request['tipoCupon'];
            $cupon->fechaExpiracion=$request['fechaExpiracion'];
            if($request['estatus']){
                $cupon->estatus='A';
            }else{
                $cupon->estatus='I';
            }
              
            $cupon->save();
    
  
    
            flash('Cupón modificado con exito')->success()->important();
          
             return redirect()->route('cupon.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cupon=Cupon::findOrFail($id);
        $cupon->delete();
        flash('Cupón eliminado con exito')->success()->important();
        return redirect()->route('cupon.index');
    }

    public function aplicarDescuento(Request $request){

      

        \Session::forget('montoCupon');
        \Session::forget('codigoCupon');

        $v=Validator::make($request->all(),[
            'codigoCupon'=>'required|exists:cupons,codigoCupon'   
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        $cupon=Cupon::where('codigoCupon',$request->codigoCupon)->first();
        
            if($cupon->estatus=='I'){
                \flash('El cupón no está disponible')->important()->warning();
                return redirect()->route('carrito'); 
            }

            $fechaActual=date('Y-m-d');
            $fechaExpiracion=$cupon->fechaExpiracion;
            if($fechaExpiracion< $fechaActual){
                \flash('Este cupón ya ha expirado')->important()->warning();
                return redirect()->route('carrito'); 
            }    
            
            $session_id=\Session::get('session_id');
            $carrito=\DB::table('carritos')->where(['session_id'=>$session_id])->get();
            $totalCantidad=0;
            foreach($carrito as $item){
                $totalCantidad=$totalCantidad+($item->precio*$item->cantidad);
            }

        if($cupon->tipoCupon=='MontoFijo'){
            $montoCupon=$cupon->cantidad;
        }else{
            $montoCupon=$totalCantidad*($cupon->cantidad/100);
            
        }
        
        \Session::put('montoCupon',$montoCupon);
        \Session::put('codigoCupon',$request->codigoCupon);
        
        flash('!Cupón cangeado con exito¡')->success()->important();
        return redirect()->route('carrito');
    }
}
