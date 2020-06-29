@extends('plantilla.contenido.perfil.perfilTienda')
@section('contenidoo')
    <div class="card-body row">
        @if(!empty($tienda->tiendaCuentaBancaria))
        <div class=" col-md-6">


            <p class="lead">Información la cuenta bancaria</p>
            <hr>



            <div class="form-group ">
                <label for="exampleInputEmail1">Nombre del banco</label>
                <input disabled type="text" value="{{$tienda->tiendaCuentaBancaria->medioPago}}" required="true"
                    name="nombreBanco" class="form-control" id="nombreBanco">
                {!!$errors->first('nombreBanco','<small>:message</small><br>')!!}

            </div>

            <div class="form-group ">
                <label for="exampleInputEmail1">Detalle de la cuenta</label>
                <input disabled type="text" value="{{$tienda->tiendaCuentaBancaria->cuenta}}" name="detalleCuenta"
                    class="form-control" id="detalleCuenta">
                {!!$errors->first('detalleCuenta','<small>:message</small><br>')!!}
            </div>



            <div class="form-group ">
                <label for="exampleInputEmail1">Documento de identidad</label>
                <div class="d-flex">
                    <select disabled name="tipo" class="form-control col-3" id="">
                        <option value="">Seleccione una opción</option>
                        <option @if($tienda->tiendaCuentaBancaria->tipodocumento=='V-')
                            selected
                            @endif
                            value="V-">V-Venezolano</option>
                        <option @if($tienda->tiendaCuentaBancaria->tipodocumento=='P-')
                            selected
                            @endif
                            value="P-">P-Pasaporte</option>
                        <option @if($tienda->tiendaCuentaBancaria->tipodocumento=='E-')
                            selected
                            @endif
                            value="E-">E-Extranjero</option>
                        <option @if($tienda->tiendaCuentaBancaria->tipodocumento=='J-')
                            selected
                            @endif
                            value="J-">J-Jurídico</option>
                        <option @if($tienda->tiendaCuentaBancaria->tipodocumento=='R-')
                            selected
                            @endif
                            value="R-">R-Firmas Personales</option>
                        <option @if($tienda->tiendaCuentaBancaria->tipodocumento=='O-')
                            selected
                            @endif
                            value="O-">O-Organización Comunal</option>
                    </select>
                    <input type="text" disabled name="documentoIdentidad" class="form-control ml-1"
                        value="{{$tienda->tiendaCuentaBancaria->documentoIndentidad}}" id="documentoIdentidad">
                </div>

            </div>


            <div class="form-group ">
                <label for="">Titular de la cuenta</label>
                <input disabled value="{{$tienda->tiendaCuentaBancaria->titular}}" class="form-control" type="text"
                    name="titularCuenta">
            </div>

            <div class="form-group">
                <label for="">Tipo cuenta</label>
                <input disabled value="{{$tienda->tiendaCuentaBancaria->tipoCuenta}}" class="form-control" type="text"
                    name="tipoCuenta">
            </div>

            <div class="form-group ">
                <label for="">Correo</label>
                <input disabled class="form-control" value="{{$tienda->tiendaCuentaBancaria->correo}}" type="text"
                    name="correo">
            </div>

            <div class="form-group ">
                <label for="">Telefono</label>
                <input disabled class="form-control" value="{{$tienda->tiendaCuentaBancaria->telefono}}" type="text"
                    name="telefono">
            </div>



        </div>
        @else
        <div class="col-md-12" style="align-items: center; justify-content: center; display: flex;">
            
            <p class="text-muted">No ha registrado una cuenta</p>
            
        </div>
        @endif
    </div>
    <div class="card-footer">
               
        <a href="{{url('/administrador/'.$user->id)}} " class="btn btn-secondary">Atrás</a>

        <a type="submit" href="{{url('/tiendas/actualizar-cuenta')}}"  class="btn btn-primary float-right">Actualizar cuenta bancaria</a>
    </div>

@endsection