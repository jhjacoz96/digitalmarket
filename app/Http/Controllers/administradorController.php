<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class administradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::findOrFail($id);
        if($user->rol_id="3"){ 
            return \view('plantilla.contenido.perfil.perfilEmpleado',compact('user'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::findOrFail($id);
        if($user->rol_id="3"){ 
            return \view('plantilla.contenido.perfil.actualizarPerfil',compact('user'));
        }
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
        $user=User::findOrFail($id);
        if($user->rol_id="3"){ 

            $v=Validator::make($request->all(),[
        
                'correo'=>'email|required|unique:users,email',
                
            ]);
    
            if ($v->fails()) {
                return \redirect()->back()->withInput()->withErrors($v->errors());
            }

            $user->email=$request->correo;
            $user->save();

            flash('La contraseña contraseña ha sido cambiada con exito!')->succes()->important();


            return \redirect()->route('administrador.show',$user);
        }
    }

    public function showPassword($id){

        $user=User::findOrFail($id);
        return view('plantilla.contenido.perfil.actualizarContraseña',compact('user'));

    }

    public function updatePassword(request $request ,$id){
        
        
        $user=User::findOrFail($id);
        if(Hash::check($request->vieja,$user->password)){
  
            $user->password =  Hash::make($request->password);
            $user->save();
            return redirect()->route('administrador.show',$user);   
         }
         else{
            flash('la contraseña ingresada no coincide con la registrada!')->warning()->important();

            return redirect()->route('Empleado.password',$user);
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
        //
    }
}
