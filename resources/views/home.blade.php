@if(Auth::user()->rol_id=="1")

	@include('tienda.index')

@endif 



	@extends('layouts.appAdmin')

	@section('contenido')

		@if (Auth::user()->rol_id=="3")
			@include('plantilla.home.administrador')
		@endif	

	@endsection


