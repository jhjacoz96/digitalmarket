<?php
use App\User;
use App\Imagen;
use App\Categoria;
use App\Rol;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;


//Rutas para imagenes:
//1)
Route::get('/prueba', function () {

   $producto=App\Producto::with('imagen','subCategoria')->orderBy('id','DESC')->get();
   return $producto;
});

//2)
//Mostrar resultados 
Route::get('/resultados', function () {
    
    $imagen=App\Imagen::orderBy('id','Desc')->get();
    return $imagen; 
});

Route::get('/', function () {
    //Mail::to("jhjacoz96@gmail.com")->send(new TestMail("Jhon"));
    //return "envioado";
    return view('tienda.index');

   /* $rol=new Rol();
    $rol->name='comprador';
    $rol->save();

    $rol=new Rol();
    $rol->name='tienda';
    $rol->save();

    $rol=new Rol();
    $rol->name='administrador';
    $rol->save();
    
    $user=new User();
    $user->nombre = 'jhon';
    $user->apellido = 'contreras';
    $user->email = 'jhjacoz96@gmail.com';
    $user->password = Hash::make('12345678');
    $user->rol_id =3;
    $user->save();*/


});


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');


Route::resource('Comprador', 'compradorController');

//Route::get('Perfil/{usuario}','controladorAdministrador@show');

Route::resource('administrador', 'administradorController');

Route::get('ActualizarContraseña/{user}','administradorController@showPassword')->name('Empleado.password');

Route::post('ActualizarContraseña/{user}','administradorController@updatePassword')->name('Empleado.updatePassword');

//Administrador cambia contraseña de cliente
Route::get('Contraseña/{comprador}','compradorController@showPassword')->name('Comprador.password');

Route::post('ActualizarContraseña/{comprador}','compradorController@updatePassword')->name('comprador.updatePassword');

Route::resource('Plan', 'planController');

Route::resource('categoria','categoriaController');
Route::resource('SubCategoria','subCategoriaController');

Route::get('traerCategoria/{categoria}',
'subCategoriaController@traer')->name('traerCategoria.traer');

route::get('obtenerTienda/{tienda}','productoController@obtenerTienda');
Route::get('obtenerCategoria/{categoria_id}','productoController@getSubCategoria');
Route::get('producto/categoria','productoController@Categoria')->name('producto.categoria');
Route::resource('producto','productoController');

Route::delete('/eliminarImagen/{id}','productoController@eliminarImagen')->name('delete.imagen');

//autocomplete
route::get('/autoComplete','HomeController@autoComplete')->name('autocomplete');

//------crear filtro direccion direcciones-------------

//zona//
route::get('filtroDirecccion/{id}/eliminarZona','filtroDireccionController@eliminarZona')->name('filtroDireccion.zona.eliminar');

route::get('filtroDireccion/{id}/editZona','filtroDireccionController@editZona')->name('filtroDireccion.zona.edit');

route::put('filtroDireccion/{zona}/updateZona','filtroDireccionController@updateZona')->name('filtroDireccion.zona.update');
//fin zona//

//parroquia
route::get('filtroDireccion/{id}/eliminarParroquia','filtroDireccionController@eliminarParroquia')->name('filtroDireccion.parroquia.eliminar');

route::get('filtroDireccion/{id}/editParroquia','filtroDireccionController@editParroquia')->name('filtroDireccion.parroquia.edit');

route::put('filtroDireccion/{parroquia}/updateParroquia','filtroDireccionController@updateParroquia')->name('filtroDireccion.parroquia.update');
//parroquia//

//Municipio
route::get('filtroDireccion/{id}/eliminarMunicipio','filtroDireccionController@eliminarMunicipio')->name('filtroDireccion.municipio.eliminar');

route::get('filtroDireccion/{id}/editMunicipio','filtroDireccionController@editMunicipio')->name('filtroDireccion.municipio.edit');

route::put('filtroDireccion/{municipio}/updateMunicipio','filtroDireccionController@updateMunicipio')->name('filtroDireccion.municipio.update');
//fin Municipio//

//estado
route::get('filtroDireccion/{id}/eliminarEstado','filtroDireccionController@eliminarEstado')->name('filtroDireccion.estado.eliminar');

route::resource('filtroDireccion','filtroDireccionController');
//fin estado

//------fin filtro direccion direcciones-------------

//------atributosProductos------------

Route::post('combinacion/atributos','atributoController@guardarCombinacion')->name('guardarCombinacion');
route::resource('combinacion','atributoController');

route::get('grupoAtributo/{id}/eliminadarAtributo','grupoAtributoController@eliminarAtributo')->name('grupoAtributo.atributo.delete');
Route::resource('grupoAtributo', 'grupoAtributoController');

Route::resource('atributo', 'atributosController');
//------fin atributosProductos------------//

//------tipos de compradores-------------
Route::resource('tipoComprador','tipoCompradorController');
 
//----fin de tipos de cliente--------

//-----Direcciones de compradores-----
route::get('getZona/{id}','direccionController@getZona');
route::get('getParroquia/{id}','direccionController@getParroquia');
route::get('getMunicipio/{id}','direccionController@getMunicipio');
route::get('getEstado','direccionController@getEstado');
route::get('getComprador/{correo}','direccionController@getComprador')->name('getComprador');
Route::resource('comprador/direccion', 'direccionController');
//----fun de direcciones de compradores------

//metodo de envio//

route::resource('metodoEnvio','metodoEnvioController');

// fin de metodo de envio//

//metodo de pago//

route::resource('metodoPago','metodoPagoController');
route::resource('bancoMetodoPago','bancoMetodoPagoController');

// fin de metodo de pago//

//tienda//
Route::get('contraseña/{tienda}','tiendaController@showPassword')->name('tienda.password');

Route::post('tiendaContraseña/{tienda}','tiendaController@updatePassword')->name('tienda.updatePassword');

route::resource('tienda','tiendaController');
//fin de tienda//

////////////////////////////////////////////////////////
////////////////////////////////////////////////////////
////////////////////////////////////////////////////////

route::prefix('tienda')->name('tienda.')->group(function(){
    route::resource('producto','productoController');
});