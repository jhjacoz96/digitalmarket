<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tienda;
use App\User;
use App\PlanAfilizacion;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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
        
        $tienda=Tienda::where('nombreTienda','like',"%$nombre%")->paginate(2);
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
}
