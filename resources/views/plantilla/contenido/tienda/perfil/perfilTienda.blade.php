@extends('plantilla.contenido.perfil.perfilTienda')
@section('contenidoo')    
    <div class="card-body row">
        <div class=" col-md-6">
                
                            
            <p class="lead">Información de la tienda</p>
            <hr>
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre del encargado</label>
                <input type="text" required="true" name="nombre" value="{{$tienda->nombre}}" class="form-control" id="nombre" placeholder="Ingrese su nombre" disabled>
            </div>
        
            <div class="form-group">
                <label for="exampleInputEmail1">Apellido del encargado</label>
                <input type="text" required="true" value="{{$tienda->apellido}}"
                name="apellido" class="form-control" id="apellido" placeholder="Ingrese su apellido" disabled>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Telefono</label>
                <input type="text" required="true" value="{{$tienda->telefono}}"
                name="telefono" class="form-control" id="telefono" placeholder="Ingrese su apellido" disabled>
            </div>
            
            
            <p class="lead">Información para la sesión</p>
            <hr>
                
            <div class="form-group">
                <label for="exampleInputEmail1">Correo electrónico</label>
                <input type="text" required="true" name="correo" class="form-control" value="{{$tienda->correo}}"id="correo" placeholder="Ingrese un correo electrónico" disabled>
            </div>

        </div>
    </div>
    <div class="card-footer">
            
        <a type="submit" href="{{route('Empleado.password',$user->id)}}" class="btn btn-secondary float-left">Actualizar contraseña</a>

        <a type="submit" href="{{route('administrador.edit',$user->id)}}"  class="btn btn-primary float-right">Actualizar perfil</a>
    </div>
@endsection