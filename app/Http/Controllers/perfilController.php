<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comprador;
use App\User;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class perfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     
        $user= user::findOrFail($id);
        $comprador=Comprador::where('id',$user->comprador->id)->first();
   
        return view('plantilla.tiendaContenido.perfil.editarPerfil.perfil',compact('comprador'));
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

        return view('plantilla.tiendaContenido.perfil.editarPerfil.contrasena',compact('user'));
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
            'nombre'=>'required',
            'apellido'=>'required',
            'email'=>'required|unique:users,email,'.$id
            
        ]);
        
        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
        
        $user=User::findOrFail($id);
        $comprador=$user->comprador;
        $user->nombre=$request->nombre;
        $user->apellido=$request->apellido;
        $user->email=$request->email;
        $user->save();
        
        $comprador->nombre=$request->nombre;
        $comprador->apellido=$request->apellido;
        $comprador->correo=$request->email;
        $comprador->save();

        flash('Sus datos han sido actualizados exito')->success()->important();

         return \redirect('/comprador/cuenta');
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

    public function CambiarContraseña(Request $request, $id){
         
        $v=Validator::make($request->all(),[
        
            'password'=>'required|string|min:8|confirmed'
            
        ]);

        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }


        $user=User::findOrFail($id);
        if(Hash::check($request->vieja,$user->password)){
  
            $user->password =  Hash::make($request->password);
            $user->save();
            flash('la contraseña ha sido actualizada con exito!')->success()->important();
            return redirect('/comprador/cuenta');   
         }
         else{
            flash('la contraseña ingresada no coincide con la registrada!')->warning()->important();

            return redirect('/comprador/perfil/'.$user->id.'/edit');
         }

    }

    public function direcciones($id){
        $user=User::FindOrFail($id);
        $direccion=$user->comprador->direccion;
        return view('plantilla.tiendaContenido.perfil.direccion.consultar',compact('direccion')); 
    }
}
