<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use App\Comprador;
use App\TipoComprador;
use App\User;
use App\Pedido;
use App\Calificacion;
use App\Producto;
use App\MetodoPagoPedido;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Email;

class userController extends Controller
{
    public function registrar(Request $request){

        if($request->isMethod('post')){
            $v=Validator::make($request->all(),[
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => [ 'required','string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
    
            if ($v->fails()) {
                return \redirect()->back()->withInput()->withErrors($v->errors());
            }

            if($request['rol_id']==1){

                $user=new User();
                 $user->nombre= $request['nombre'];
                $user->apellido = $request['apellido'];
                $user->email = $request['email'];
                $user->password = Hash::make($request['password']);
                $user->rol_id = $request['rol_id'];
                $user->save();

                $comprador=new Comprador();
                $comprador->nombre=$request['nombre'];
                $comprador->apellido=$request['apellido'];
                $comprador->correo=$request['email'];
                $comprador->user_id=$user->id;

                $tipoComprador=TipoComprador::where('nombre','Comprador')->orWhere('nombre','comprador')->first();

                $comprador->tipoComprador_id=$tipoComprador->id;
                $comprador->save();

                //enviar correo de bienvenida
                $email=$request['email'];
                $datoMensaje=['email'=>$request['email'],'nombre'=>$request['nombre']];
                \Mail::send('correos.registro',$datoMensaje,function($mensaje) use ($email){
                    $mensaje->to($email)->subject('Registro en DigitalMarcket');
                });

                if (\Auth::attempt(['email' => $request['email'], 'password' => $request['password']]))
                {
                    \Session::put('frontSession',$comprador->id);

                    if(!empty(\Session::get('session_id'))){
                        $session_id=\Session::get('session_id');
                        \DB::table('carritos')->where('session_id',$session_id)->update(['comprador_id'=>$comprador->id]);
                    }

                    return redirect('/');
                }
               
            }
        }

        return view('auth.registrar');
        
    }

    public function iniciarSesion(Request $request){


        if($request->isMethod('post')){

            $v=Validator::make($request->all(),[
                'email' => ['required'],
                'password' => ['required', 'string', 'min:8'],
            ]);
    
            if ($v->fails()) {
                return \redirect()->back()->withInput()->withErrors($v->errors());
            }

            if (\Auth::attempt(['email' => $request['email'], 'password' => $request['password']]))
                {   
                    if(\Auth::user()->rol_id==3||\Auth::user()->rol_id==2){
                        return redirect('/home');
                    }
                    if(\Auth::user()->rol_id==1){
                        
                        \Session::put('frontSession',\Auth::user()->comprador->id);

                            if(!empty(\Session::get('session_id'))){
                                $session_id=\Session::get('session_id');
                                \DB::table('carritos')->where('session_id',$session_id)->update(['comprador_id'=>\Auth::user()->comprador->id]);
                            } 

                        return redirect('/');
                    }
                }else{
                    \flash('Los datos ingresados no coinciden con ningun registro')->important()->warning();
                    return redirect('/iniciar-sesion');
                }

       
         }
         return view('auth.iniciarSesion');
    }
    public function cerrarSesion(){
        \Auth::logout();
        \Session::forget('frontSession');
        \Session::forget('session_id');
        if(!empty(\Session::get('$montoDescuentoTipoComrador'))){
            \Session::forget('$montoDescuentoTipoComrador');
        }
        return redirect('/');
    }

    public function cuenta(Request $request){
        if($request->isMethod('post')){
            
        }
        return view('plantilla.tiendacontenido.cuenta');
    }

   public function compradorPedidos(){
       $comprador=\Auth::user()->comprador;
       $pedido=Pedido::where('comprador_id',$comprador->id)->with('producto')->get();
    
       return view('plantilla.tiendaContenido.perfil.pedidos',compact('pedido'));
   }

   public function pedidoDetalle($id){
       $comprador=\Auth::user()->comprador;
       $pedido=Pedido::with('producto')->with('metodoPago')->findOrFail($id);
       
       return view('plantilla.tiendaContenido.perfil.pedidoDetalle',compact('pedido'));
   }

   public function referenciaPago(Request $request,$idPago){

    $v=Validator::make($request->all(),[
        'referencia'=>'required|min:10'
     
    ]);
   
    if ($v->fails()) {
        return \redirect()->back()->withInput()->withErrors($v->errors());
    }

        $pago=MetodoPagoPedido::findOrFail($idPago);
        $pago->referencia=$request->referencia;
        $pago->status='Confirmación';
        $pago->save();
        flash('Su referencia a sido enviada. Una vez sus pagos sean validados se le notificará mediante un correo.')->success()->important();
                return redirect('/comprador/pedidoDetalle/'.$pago->pedido_id);
   }

   public function calificar(Request $request){
       
        $v=Validator::make($request->all(),[
            'estrellas'=>'required',
            'producto_id'=>'required',
            'titulo'=>'required',
            'comentario'=>'required'
        ]);
        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        $c=Calificacion::where(['producto_id'=>$request->producto_id,'comprador_id'=>\Auth::user()->comprador->id])->count();
        
        if($c>0){
            flash('Ya ha calificado este producto.')->warning()->important();
            return redirect()->back();
        }

        $calificacion=new Calificacion;

        
        $calificacion->titulo=$request->titulo;
        $calificacion->comentario=$request->comentario;
        $calificacion->calificacion=$request->estrellas;
        $calificacion->producto_id=$request->producto_id;
        $calificacion->comprador_id=\Auth::user()->comprador->id;
        $calificacion->save();
        $pedido=Pedido::findOrFail($request->pedido_id);
        $producto=Producto::findOrFail($request->producto_id);
        $pedido->status='culminado';
        $pedido->save();   

        flash('Se ha enviado la calificación del producto: ' . $producto->nombre . ' ,perteneciente al pedido ' . $pedido->id . '.' )->success()->important();
        return redirect()->back();

   }


}
