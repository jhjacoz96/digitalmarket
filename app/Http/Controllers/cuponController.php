<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use \App\Cupon;
use \App\TipoComprador;
use \App\Comprador;
use \App\Pedido;

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
              
       
        $cupon=Cupon::where('codigoCupon','like',"%$codigo%")->with('tipoComprador')->get();
       
        return view('plantilla.contenido.admin.cupon.consultar',compact('cupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoComprador=TipoComprador::where('estatus',1)->get();
        return view('plantilla.contenido.admin.cupon.crear',compact('tipoComprador'));
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
            'fechaExpiracion'=>'required',
            'tipo'=>'required'
            
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

        $tipo=$request->tipo;
        for($i=0; $i <count($tipo) ; $i++){

            $comprador=Comprador::where('tipoComprador_id',$tipo)->get();
            for ($j=0; $j < count($comprador) ; $j++) { 
                
                $correo=$comprador[$j]['correo'];
                $datosMensaje=[
                    'correo'=>$comprador[$j]['correo'],
                    'nombre'=>$comprador[$j]['nombre'],
                    'cupon'=>$cupon
                ];
     
                Mail::send('correos.cuponDescuento',$datosMensaje,function($mensaje) use($correo){
                    $mensaje->to($correo)->subject('Cupón de escuento - DigitalMarket');
                });
            }

            $cupon->tipoComprador()->attach($tipo[$i]);
        }



        flash('Cupón agregado con exito')->success()->important();
       
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
        $cupon=Cupon::with('tipoComprador')->findOrFail($id);
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

        $cupon=Cupon::where('codigoCupon',$request->codigoCupon)->with('tipoComprador')->first();
        
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

        if(\Auth::check()){
            $comprador_id=\Auth::user()->comprador->id;
            $tipoComprador=\Auth::user()->comprador->tipoComprador;
            $carrito=\DB::table('carritos')->where(['comprador_id'=>$comprador_id])->get();
        }else{
            \flash('Debe autenticarse para poder canjear un cupón de descuento')->important()->warning();
            return redirect()->route('carrito'); 
           /* $session_id=\Session::get('session_id');
            $carrito=\DB::table('carritos')->where(['session_id'=>$session_id])->get();*/
        }


        $totalCantidad=0;
        foreach($carrito as $item){
            $totalCantidad=$totalCantidad+($item->precio*$item->cantidad);
        }   
     
        $comprador=\Auth::user()->comprador;
        $tc=$cupon->tipoComprador;
        
        
    
        for ($i=0; $i <count($tc) ; $i++) {

            if($tc[$i]['id']==$comprador->tipoComprador->id){

                if($cupon->tipoCupon=='Porcentaje'){    

                    $pedido=Pedido::where('comprador_id', $comprador->id)->where('codigoCupon',$cupon->codigoCupon)->count();
    
                    if($pedido<=0){
                        
                        $montoCupon=$totalCantidad*($cupon->cantidad/100);
                        
                        \Session::put('montoCupon',$montoCupon);
                        \Session::put('codigoCupon',$request->codigoCupon);
                        
                        flash('!Cupón cangeado con exito¡')->success()->important();
                        return redirect()->route('carrito');
    
                    }else{
    
                        flash('Usted ya ha cangeado este cupón')->warning()->important();
                        return redirect()->route('carrito');
                        
                    }

                }else{

                    $montoCupon=$cupon->cantidad;
                    $cantidadd=Pedido::where('comprador_id', $comprador->id)->where('codigoCupon',$cupon->codigoCupon)->count();

                    if($cantidadd>0){
                        flash('Usted ya ha usado este cupón de descuento.')->warning()->important();
                        return redirect()->route('carrito');
                    }

                    if($totalCantidad>=$montoCupon){
                        
                        \Session::put('montoCupon',$montoCupon);
                        \Session::put('codigoCupon',$request->codigoCupon);
                        
                        flash('!Cupón cangeado con exito¡')->success()->important();
                        return redirect()->route('carrito');

                    }else{

                        flash('Este cupón no es acumulativo. Debe usarlo en un carrito donde el monto total sea mayor o igual a al monto del cupón.')->warning()->important();
                        return redirect()->route('carrito');

                    }

                }

            }
        }

        flash('Lo sentimos este cupón no esta disponible')->warning()->important();
        return redirect()->route('carrito');
       
            
            
        

    }
}
