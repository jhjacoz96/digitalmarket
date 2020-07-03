<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tienda;
use App\User;
use Carbon\Carbon;
use App\Pedido;
use App\PlanAfilizacion;
use App\PagoTiendaPedido;
use App\TiendaCuentaBancaria;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Notifications\pedidoNotification;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class tiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre=$request->get('nombre');
        
        $tienda=Tienda::where('nombreTienda','like',"%$nombre%")->get();
        return view('plantilla.contenido.admin.tienda.consultar',compact('tienda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan=PlanAfilizacion::All();
        return view('plantilla.contenido.admin.tienda.crear',compact('plan'));
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
            'nombreTienda'=>'required',
            'nombre'=>'required',
            'apellido'=>'required',
            'telefono'=>'required',
            'telefono'=>'required',
            'planAfiliacion'=>'required',
            'correo'=>'required|email|unique:users,email',
            'password'=>'required|confirmed'


        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        $user = new User();
        $user->nombre = $request->nombre ;
        $user->apellido = $request->apellido ;
        $user->email = $request->correo ;
        $user->estatus = 'A' ;
        $user->rol_id = 2 ;
        $user->password = Hash::make( $request->password);

       
        $user->save();


        $tienda = new Tienda();

        $tienda->nombreTienda=$request->nombreTienda;
        $tienda->nombre=$request->nombre;
        $tienda->apellido=$request->apellido;  
        $tienda->fechaPlanAfiliacion=Carbon::now()->format('Y-m-d H:i:s');  
        $tienda->telefono=$request->telefono;  
        $tienda->planAfilizacion_id=$request->planAfiliacion;  
        $tienda->correo=$request->correo;  
        
        $numero=count(Tienda::All()) + 1;
        $nombre=strtoupper($tienda->nombreTienda);

        $tienda->codigo=$nombre[0].$nombre[1]. 00 .$numero;
        $tienda->user_id=$user->id; 

        if( $request->estatus){
            $tienda->estatus='A';
        }else{
            $tienda->estatus='I';
        }
        
        
        $tienda->save();

        $tiendaCuentaBancaria=new TiendaCuentaBancaria();
                $tiendaCuentaBancaria->tienda_id=$tienda->id;
                $tiendaCuentaBancaria->save();

        \flash('Tienda agregada con exito')->success()->important();

        return \redirect()->route('tienda.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tienda=Tienda::with('producto')->findOrFail($id);
        
        return view('plantilla.contenido.admin.tienda.detalle',compact('tienda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tienda=Tienda::findOrFail($id);
        $plan=PlanAfilizacion::All();
        return view('plantilla.contenido.admin.tienda.modificar',compact('tienda'),compact('plan'));
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
            'nombreTienda'=>'required',
            'nombre'=>'required',
            'apellido'=>'required',
            'telefono'=>'required',
            'planAfiliacion'=>'required',
            'correo'=>'required|email|unique:tiendas,correo,'.$id


        ]);
        
       

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        $tienda=Tienda::findOrFail($id);
        $user=User::findOrFail($tienda->user_id);

        $user->nombre = $request->nombre ;
        $user->apellido = $request->apellido ;
        $user->email = $request->correo ;
        $user->estatus = 'A' ;
        $user->rol_id = 2 ;
        $user->password = Hash::make( $request->password);

       
        $user->save();


        

        $tienda->nombreTienda=$request->nombreTienda;
        $tienda->nombre=$request->nombre;
        $tienda->apellido=$request->apellido;  
      
        $pedido=Pedido::whereHas('producto',function($q) use($tienda){
            $q->where('tienda_id', $tienda->id);
            })->where('status','!=','culminado')->count();
        
        
        if($tienda->planAfilizacion_id!=$request->planAfiliacion){

            if($pedido>=0){
                flash('Lo sentimos. No puede afiliarse a un plan si posee pedidos en proceso de compra.')->warning()->important();
                return \redirect()->route('tienda.index');
            }else{

                $tienda->planAfilizacion_id=$request->planAfiliacion;
                $tienda->fechaPlanAfiliacion=Carbon::now()->format('Y-m-d H:i:s');
            }

        }

        $tienda->telefono=$request->telefono;  

        $tienda->planAfilizacion_id=$request->planAfiliacion;  
        $tienda->correo=$request->correo;  
        
        $tienda->user_id=$user->id; 

        if( $request->estatus){
            $tienda->estatus='A';
        }else{
            $tienda->estatus='I';
        }
        
        
        $tienda->save();

       
        \flash('Tienda actualizada con exito')->success()->important();

        return \redirect()->route('tienda.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showPassword($id){
        $tienda=Tienda::findOrFail($id);

        return view('plantilla.contenido.admin.tienda.modificarPassword',compact('tienda')); 

    }

    public function updatePassword(Request $request,$id){
       
     

        $v=Validator::make($request->all(),[
        
            'password'=>'required|string|min:8|confirmed'
            
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        $tienda=Tienda::findOrFail($id);
        $user=User::findOrFail($tienda->user_id);
        
        if(Hash::check($request->vieja,$user->password)){
  
            $user->password =  Hash::make($request->password);
            $user->save();
            flash('La contraseña ha sido actualizada con exito!')->succsess(); 
            return redirect()->route('tienda.edit',$comprador);   
         }
         else{
            flash('La contraseña ingresada no coincide con la registrada!')->warning();

            return redirect()->route('tienda.password',$tienda);
         }
        }  

    public function destroy($id)
    {
        
        $tienda=Tienda::with('producto')->findOrFail($id);
      
        if(count($tienda->producto)==0){
            $tienda->delete();

            \flash('Tienda eliminada con exito')->success()->important();
            return \redirect()->route('tienda.index');
        }else{
            \flash('No es posible eliminar esta tienda ya que posee  ' . count($tienda->producto) . ' producto(s) asociado(s)')->warning()->important();
            return \redirect()->route('tienda.index');
        }

    }

    public function montrarPagos(){
        $tiendaPago=PagoTiendaPedido::whereHas('pedido',function($q){
            $q->where('status','enviadoComprador');
        })->get();
        return view('plantilla.contenido.admin.pagos.consultar',compact('tiendaPago'));
    }

    public function tiendaPago($id){
        $pagoTiendaPedido=PagoTiendaPedido::findOrFail($id);
        $tienda=Tienda::with('tiendaCuentaBancaria')->findOrFail($pagoTiendaPedido->tienda->id);
        
        return view('plantilla.contenido.admin.pagos.pagar',compact('pagoTiendaPedido','tienda'));
    }

    public function pagar($id){
        $pagoTiendaPedido=PagoTiendaPedido::findOrFail($id);
        $pagoTiendaPedido->status='pagado';
        $pagoTiendaPedido->save();

        $correo=$pagoTiendaPedido->tienda->correo;
        $datosMensaje=[
            'correo'=>$correo,
            'nombre'=>$pagoTiendaPedido->tienda->nombre,
            'pedido'=>$pagoTiendaPedido->pedido->id,
            'pagoTiendaPedido'=>$pagoTiendaPedido
        ];

        $comment = 'pagoRealizado'; 
        $pagoTiendaPedido->tienda->notify(new pedidoNotification($comment, $pagoTiendaPedido->pedido->id));

        Mail::send('correos.pagoTienda',$datosMensaje,function($mensaje) use($correo){
            $mensaje->to($correo)->subject('Pago de pedido - DigitalMarket');
        });

        flash('El pedido ' . $pagoTiendaPedido->pedido->id . ' ha sido pagado a la tienda ' .  $pagoTiendaPedido->tienda->nombreTienda . ' por un monto de  Bs'. $pagoTiendaPedido->montoPagado . ' ')->important()->success();
        return redirect('/pagos-tiendas');
    }


    public function verCuenta(){
        
        $user=User::findOrFail(\Auth::user()->id);
        $tienda=Tienda::with('imagen')->with('tiendaCuentaBancaria')->findOrFail(\Auth::user()->tienda->id);
        return view('plantilla.contenido.tienda.perfil.VerCuentaTienda',compact('tienda','user'));
    }

    public function actualizarCuenta(){
        $user=User::findOrFail(\Auth::user()->id);
        $tienda=Tienda::with('imagen')->with('tiendaCuentaBancaria')->findOrFail(\Auth::user()->tienda->id);
        $tiendaCuentaBancaria=$tienda->tiendaCuentaBancaria;
        if($tienda->tiendaCuentaBancaria){
        
            return view('plantilla.contenido.tienda.perfil.actualizarCuentaBancaria',compact('tienda','user'));
        }else{
            $tiendaCuentaBancaria=new TiendaCuentaBancaria();
            $tiendaCuentaBancaria->tienda_id=$tienda->id;
            $tiendaCuentaBancaria->save();
            $tienda=Tienda::with('imagen')->with('tiendaCuentaBancaria')->findOrFail(\Auth::user()->tienda->id);
            return view('plantilla.contenido.tienda.perfil.actualizarCuentaBancaria',compact('tienda','user'));
        }
    } 

    public function modificarCuenta(Request $request,$id){
        $t=\Auth::user()->tienda->tiendaCuentaBancaria;
          
        $tiendCuentaBancaria=TiendaCuentaBancaria::findOrFail($t->id);
        $tiendCuentaBancaria->medioPago=$request->nombreBanco;
        $tiendCuentaBancaria->moneda='bolivar';
        $tiendCuentaBancaria->cuenta=$request->detalleCuenta;
        $tiendCuentaBancaria->tipoDocumento=$request->tipo;
        $tiendCuentaBancaria->documentoIndentidad=$request->documentoIdentidad;
        $tiendCuentaBancaria->titular=$request->titularCuenta;
        $tiendCuentaBancaria->tipoCuenta=$request->tipoCuenta;
        $tiendCuentaBancaria->telefono=$request->telefonoCuenta;
        $tiendCuentaBancaria->correo=$request->correoCuenta;
        $tiendCuentaBancaria->tienda_id=\Auth::user()->tienda->id;
        $tiendCuentaBancaria->save();

        flash('Se ha actualizado la cuenta bancaria con exito!')->success()->important();

        return \redirect()->route('administrador.show',\Auth::user()->id);

    }

    public function cambiarPlan($id){
       $plan=PlanAfilizacion::find($id);

       $tienda=\Auth::user()->tienda;

       $pedido=Pedido::whereHas('producto',function($q) use($tienda){
        $q->where('tienda_id',$tienda->id);
        })->where('status','!=','culminado')->count();
     
        if($pedido>0){
            flash('Lo sentimos. No puede afiliarse a un plan si posee pedidos en proceso de compra.')->warning()->important();

            return \redirect('/home');
        }else{

            flash('Usted se ha afiliado al plan ' . $plan->nombre . ' . Debe tener en cuenta que el procentaje por venta es de ' . $plan->precio.'%.')->success()->important();

            return \redirect('/home');

        }

    }


}
