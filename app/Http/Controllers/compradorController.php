<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comprador;
use App\User;
use App\TipoComprador; 
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\compradorRequest;
class compradorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $comprador=Comprador::All();
        return view('plantilla.contenido.admin.comprador.consultar')->with('comprador',$comprador);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo=TipoComprador::where('estatus',1)->get();
        return view('plantilla.contenido.admin.comprador.crear',compact('tipo'));
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
            'nombre'=>'min:2|required',
            'apellido'=>'min:2|required',
            'correo'=>'email|required|unique:compradors,correo',
            'password_confirmation'=>'required|min:8',
            'password'=>'required|min:8|confirmed'
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
        
            $user=new User();
            /*$user->nombre=$request->nombre;
            $user->apellido=$request->apellido;*/
            $user->email=$request->correo;
            $user->password =  Hash::make( $request->password);
            $user->rol_id=1;            
            $user->save();

            $comprador=new Comprador();
            $comprador->nombre=$request->nombre;
            $comprador->apellido=$request->apellido;
            $comprador->correo=$request->correo;
            $comprador->user_id=$user->id;
            if($request->tipoComprador==null){
                $comprador->tipoComprador_id=1;
            }else{
                $comprador->tipoComprador_id=$request->tipoComprador;
            }

            if($request->activo){
                $comprador->estatus='A';
            }else{
                $comprador->estatus='I';
            }

            $comprador->save();

            flash('Comprador agregado con exito')->success()->important();

            return redirect()->route('Comprador.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comprador=Comprador::with('direccion')->findOrFail($id);
      
        return view('plantilla.contenido.admin.comprador.detalle',compact('comprador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comprador=Comprador::findOrFail($id);
        $tipo=TipoComprador::where('estatus',1)->get();
        return view('plantilla.contenido.admin.comprador.modificar',compact('comprador'),compact('tipo'));
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
            'nombre'=>'min:2|required',
            'apellido'=>'min:2|required',
            'correo'=>'email|required|unique:compradors,correo,'.$id
            
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
      

        $comprador=Comprador::findOrFail($id);
        
        $comprador->nombre=$request->nombre;
        $comprador->apellido=$request->apellido;
        $comprador->tipoComprador_id=$request->tipoComprador;
        $comprador->correo=$request->correo;
        if($request->tipoComprador==null){
            $comprador->tipoComprador_id=1;
        }else{
            $comprador->tipoComprador_id=$request->tipoComprador;
        }
        if($request->activo){
            $comprador->estatus='A';
        }else{
            $comprador->estatus='I';
        }

        $comprador->save();

        $user=User::findOrFail($comprador->user_id);
        $user->nombre=$request->nombre;
        $user->apellido=$request->apellido;
        $user->email=$request->correo;
        $user->update();
        
        flash('Comprador modificado con éxito')->success()->important();
        return redirect()->route('Comprador.index');
    }

    public function showPassword($id){
        $comprador=Comprador::findOrFail($id);

        return view('plantilla.contenido.admin.comprador.modificarPassword',compact('comprador')); 

    }

    public function updatePassword(Request $request,$id){
       
        $comprador=Comprador::findOrFail($id);
        $user=User::findOrFail($comprador->user_id);
        if(Hash::check($request->vieja,$user->password)){
  
            $user->password =  Hash::make($request->password);
            $user->save();
            flash('La contraseña ha sido actualizada con exito!')->succsess(); 
            return redirect()->route('Comprador.edit',$comprador);   
         }
         else{
            flash('La contraseña ingresada no coincide con la registrada!')->warning();

            return redirect()->route('Comprador.password',$comprador);
         }
        }  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $comprador=Comprador::findOrFail($id);
        
        $usuario=User::findOrFail($comprador->user_id);
        $comprador->user_id=null;
        $comprador->estatus='I';
        $comprador->update();
        $usuario->delete();
        flash('Comprador eliminado con exito')->success()->important();
        return redirect()->route('Comprador.index');
    }
}
