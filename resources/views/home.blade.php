@if(Auth::user()->rol_id=="1")

	@include('tienda.index')

@endif 



	@if(Auth::user()->rol_id=="3" || Auth::user()->rol_id=="2")
	@extends('layouts.appAdmin')

	@section('contenido')
		@if(Auth::user()->rol_id=="2")
			@include('plantilla.home.tienda');
		@endif
		@if (Auth::user()->rol_id=="3")
			@include('plantilla.home.administrador')
		@endif

	@endsection
	@endif

