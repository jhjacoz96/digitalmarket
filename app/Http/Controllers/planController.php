<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlanAfilizacion;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;

class planController extends Controller
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
        $plan=PlanAfilizacion::All();
       
        return \view('plantilla.contenido.admin.planAfiliacion.consultar',compact('plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plantilla.contenido.admin.planAfiliacion.agregar');
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
            'nombre'=>'min:2|required|unique:plan_afilizacions,nombre',
            'descripcion'=>'max:128|required',
            'exposicion'=>'required',
            'porcentaje'=>'required'
            
        ]);
        
        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }

        $plan=new PlanAfilizacion();
        $plan->nombre=$request->nombre;
        $plan->descripcion=$request->descripcion;
        $plan->exposicion=$request->exposicion; $plan->tiempoPublicacion=$request->tiempoPublicacion;
        $plan->cantidadPublicacion=$request->cantidadPublicacion;
        $plan->precio=$request->porcentaje;
        
        if($request->activo){
            $plan->estatus='A';
        }else{
            $plan->estatus='I';
        }
        $plan->save();


        flash('Plan de afiliación agregado con exito')->success()->important();

         return \redirect()->route('Plan.index');
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
        $plan=PlanAfilizacion::findOrFail($id);
         
        return \view('plantilla.contenido.admin.planAfiliacion.modificar',\compact('plan'));

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
            'nombre'=>'min:2|required|unique:plan_afilizacions,nombre,'.$id,
            'descripcion'=>'max:128|required',
            'exposicion'=>'required',
            'porcentaje'=>'required'
            
        ]);
            
        if ($v->fails()) {
            return \redirect()->back()->withInput()->withErrors($v->errors());
        }
       
        $plan=PlanAfilizacion::findOrFail($id);
        $plan->nombre=$request->nombre;
        $plan->descripcion=$request->descripcion;
        $plan->exposicion=$request->exposicion;
        $plan->tiempoPublicacion=$request->tiempoPublicacion;
        $plan->cantidadPublicacion=$request->cantidadPublicacion;
        $plan->precio=$request->porcentaje;
        
        if($request->activo){
            $plan->estatus='A';
        }else{
            if($request->nombre=='Gratuita'||$request->nombre=='gratuita'){
                $plan->estatus='A';
            }else{

                $plan->estatus='I';
            }
        }
        $plan->save();
        
        flash('Plan de afiliación modificado con exito')->success()->important();

         return \redirect()->route('Plan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan=PlanAfilizacion::findOrFail($id);
        $plan->delete();
        flash('Plan de afiliación eliminado con exito')->success()->important();
        return \redirect()->route('Plan.index');

    }
}
