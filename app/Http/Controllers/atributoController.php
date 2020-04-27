<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GrupoAtributo;
use App\Atributo;
use App\Combinacion;

class atributoController extends Controller
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
        
        $combinacion=Combinacion::with('atributo')->get();

        return view('plantilla.contenido.admin.combinacion.crear',compact('combinacion'));
    }

 

    public function guardarCombinacion(Request $request){
        $d=json_decode(($request['value']),true);
        for ($i=0; $i < count($d) ; $i++) { 
            $combinacion = new Combinacion();
            $combinacion->cantidad=$d[$i]['cantidad'];
            $combinacion->save();
            $s=$d[$i]['elemento'];
            for ($j=0; $j <count($s) ; $j++) { 
                $combinacion->atributo()->attach($s[$j]['id']);
            }

        }

        return 'dd';        
    }

    public function create()
    {
        $ga=GrupoAtributo::with('atributo')->get();
        
        return $ga;

    }
       
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $grupoAtributo=new GrupoAtributo();
        $grupoAtributo->nombre=$request->nombre;

        $grupoAtributo->save();

        for ($i=0; $i < count($request->atributos) ; $i++) { 
            
            $atributo=new Atributo();

           $atributo->nombre = $request->atributos[$i];
           $atributo->grupoAtributo_id= $grupoAtributo->id;
            $atributo->save();
        }

        $g=GrupoAtributo::where('id',$grupoAtributo->id)->with('atributo')->first();
        
        return $g;

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
        $combinacion=Combinacion::with('atributo')->where('producto_id',$id)->get();
        return $combinacion;
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
         $combinacion=Combinacion::findOrfail($id);
         $combinacion->cantidad=$request->cantidad;
            $combinacion->save();
        return $combinacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
       $combinacion=Combinacion::findOrFail($id);
       $combinacion->delete();
       

    }
}
