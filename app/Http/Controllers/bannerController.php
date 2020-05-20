<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imagen;
use App\Banner;

use Illuminate\Support\Facades\File;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;

class bannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $banner=Banner::with('imagen')->paginate(2);
        return view('plantilla.contenido.admin.banner.consultar',compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plantilla.contenido.admin.banner.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $banner=new Banner();
        $banner->link=$request->link;
        $banner->titulo=$request->titulo;
        if($request->estatus){
            $banner->estatus='si';
        }else{
            $banner->estatus='no';
        }

       
            $imagen=$request->file('imagen');
           
            $nombre=time().'_'.$imagen->getClientOriginalName();
            $ruta=public_path().'/imagenes/banners';
            $imagen->move($ruta , $nombre);

            $urlImagen['url']='/imagenes/banners/'.$nombre;
            

        $banner->save();

            $banner->imagen()->create($urlImagen);

            \flash('Banner agregado con exito')->important()->success();

            return \redirect()->route('banner.index');
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
        $banner=Banner::findOrFail($id);
        return view('plantilla.contenido.admin.banner.modificar',compact('banner'));
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
        $banner=Banner::findOrFail($id);
        $banner->link=$request->link;
        $banner->titulo=$request->titulo;
        if($request->estatus){
            $banner->estatus='si';
        }else{
            $banner->estatus='no';
        }

        $banner->save();

        \flash('Banner actualizado con exito')->important()->success();

        return \redirect()->route('banner.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner=Banner::findOrFail($id);
        $banner->delete();
        \flash('Banner eliminado con exito')->important()->success();

        return \redirect()->route('banner.index');

    }
}

