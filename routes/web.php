<?php
use App\User;
use App\Imagen;
use App\Categoria;

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
    return view('tienda.index');

    /*$user=new User();
  
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

Route::get('obtenerCategoria/{categoria_id}','productoController@getSubCategoria');
Route::get('producto/categoria','productoController@Categoria')->name('producto.categoria');
Route::resource('producto','productoController');

Route::delete('/eliminarImagen/{id}','productoController@eliminarImagen')->name('delete.imagen');

//autocomplete
route::get('/autoComplete','HomeController@autoComplete')->name('autocomplete');

//------crear filtro direccion direcciones-------------

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
Route::resource('comprador/direccion', 'direccionController');
//----fun de direcciones de compradores------