<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Comprador;
use App\Tienda;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => [ 'string', 'max:255'],
            'apellido' => [ 'string', 'max:255'],
            'nombreTienda' => ['string', 'max:255'],
            'nombreEncargado' => ['string', 'max:255'],
            'apellidoEncargado' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
            

            if($data['rol_id']==1){

                $user=new User();
                 $user->nombre= $data['nombre'];
                $user->apellido = $data['apellido'];
                $user->email = $data['email'];
                $user->password = Hash::make($data['password']);
                $user->rol_id = $data['rol_id'];
                $user->save();

                $comprador=new Comprador();
                $comprador->nombre=$data['nombre'];
                $comprador->apellido=$data['apellido'];
                $comprador->correo=$data['email'];
                $comprador->user_id=$user->id;
                $comprador->tipoComprador_id=1;
                $comprador->save();
    
                return $user;
            }

            if($data['rol_id']==2){
                $user=new User();
                $user->nombre= $data['nombreEncargado'];
                $user->apellido = $data['apellidoEncargado'];
                $user->email = $data['email'];
                $user->password = Hash::make($data['password']);
                $user->rol_id = $data['rol_id'];
                $user->save();

                $tienda=new Tienda();
                $tienda->nombreTienda=$data['nombreTienda'];
                $tienda->nombre= $data['nombreEncargado'];
                $tienda->apellido = $data['apellidoEncargado'];
                $tienda->correo=$data['email'];

                $numero=count(Tienda::All()) + 1;
                $nombre=strtoupper($data['nombreTienda']);


                $tienda->codigo=$nombre[0].$nombre[1]. 00 .$numero;
                $tienda->user_id=$user->id;
                
                $tienda->planAfilizacion_id=1;
                $tienda->save();
                
                $tiendaCuentaBancario=new TiendaCientaBancario();
                $tiendaCuentaBancario->tienda_id=$tienda->id;
                $tiendaCuentaBancario->save();

                return $user;
            }

    }

    
}
