@if(Auth::user()->rol_id=="1")

	@include('tienda.index')

@endif 

@if(Auth::user()->rol_id=="2")
 <h1>hola tienda</h1>:{{Auth::user()->nombre}}
@endif

	@if(Auth::user()->rol_id=="3")
	@extends('layouts.appAdmin')

	@section('contenido')

		@if (Auth::user()->rol_id=="3")
			@include('plantilla.home.administrador')
		@endif	

	@endsection
	@endif

