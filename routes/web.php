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

route::get('/','indexController@index');

//route::get('/','indexController@index'); 

/*Route::get('/', function () {
    //return view('plantilla.tiendaContenido.index');
    //return view('tienda.index');

});*/

route::get('/datos',function(){
     $rol=new Rol();
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
    $user->save();
    return redirect('/');
});

Auth::routes();

route::match(['get','post'],'/registrar-usuario','userController@registrar');
route::match(['get','post'],'/iniciar-sesion','userController@iniciarSesion');
route::get('/salir','userController@cerrarSesion');


Route::get('/home', 'HomeController@index')->name('home');


route::prefix('comprador')->middleware('frontLogin')->group(function(){
    route::match(['get','post'],'cuenta','userController@cuenta');
    route::get('direcciones/{id}','perfilController@direcciones');
    route::resource('perfil','perfilController');
    Route::post('actualizarContraseña/{user}','perfilController@cambiarContraseña');
    route::resource('direccion','direccionController');
    Route::match(['get', 'post'], '/calificar','userController@calificar');
    route::get('/pedidos','userController@compradorPedidos');
    route::get('/pedidoDetalle/{id}','userController@pedidoDetalle');
    route::put('/referenciaPago/{idPedido}','userController@referenciaPago');
});

//autocomplete
route::get('/autoComplete','HomeController@autoComplete')->name('autocomplete');





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
route::get('buscarGrupos/{id}','atributoController@buscarGrupo');
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

//Cupones de descuento/////
route::resource('cupon','cuponController');  
//fin cupones de descuento/////

route::resource('banner','bannerController'); 

route::resource('moneda','monedaController');

route::resource('marca','marcaController');

route::get('pedido/{tipo}','pedidoController@pedidoAdmin')->name('pedido.consultar');
route::get('pedido/detalle/{id}','pedidoController@detallePedidoAdmin')->name('pedido.detalle');
route::get('/pedido/pago/{id}/{status}','pedidoController@cambiarStatusPago');
route::put('/pedido/status/{id}','pedidoController@cambiarStatusPedido');

route::get('/pedido-factura/{id}','pedidoController@verFactura');
route::get('/descargar-ejemplo','pedidoController@descargarEjemplo');
route::get('/pago-tienda/{id}','tiendaController@tiendaPago');
route::get('/pagar/{id}','tiendaController@pagar');
route::get('/pagos-tiendas','tiendaController@montrarPagos');

//reportes graficos//
route::get('/reporte-comprador/{anio}/{mes}','reporteController@graficaComprador');
route::get('/reporte-pedido/{anio}/{mes}','reporteController@graficaPedido');
route::get('/reporte-plan/{anio}/{mes}','reporteController@graficaPlan');
route::get('/reporte-pago/{anio}/{mes}','reporteController@graficaPago');
//fin de reportes graficos//

////////////////////////////////////////////////////////
////////////////////////////////////////////////////////
////////////////////////////////////////////////////////

route::prefix('tiendas')->name('tiendas.')->middleware('auth')->group(function(){
    route::resource('producto','productoController');
    route::resource('grupoAtributo','grupoAtributoController');
    route::get('pedido/consultar','pedidoController@pedido')->name('pedido.consultar');
    route::get('pedido/detalle/{id}','pedidoController@detallePedido')->name('pedido.detalle');
    route::get('ver-cuenta','tiendaController@verCuenta');
    route::get('actualizar-cuenta','tiendaController@actualizarCuenta');
    route::put('actualizar-cuenta/{id}','tiendaController@modificarCuenta');
    route::get('cambiar-plan/{id}','tiendaController@cambiarPlan');
    route::resource('atributos','atributosController');
    route::get('/productos-masa','productoController@productoMasa')->name('producto.masivo');
    route::post('/productos-masas','productoController@productoMasas')->name('productos.masa');
});

////////////////////////////////////////////////////////
////////////////////////////////////////////////////////
////////////////////////////////////////////////////////

//FILTRAR CATEGORIAS

route::get('categorias/{slug}','productoController@productoCategoria')->name('categorias.productos');
route::get('mainCategorias/{slug}','productoController@mainProductoCategoria')->name('main.categorias.productos');

//FIN DE FILTRAR CATEGORIAS

//Prductos de la tienda

route::get('/productos/tienda/{id}','indexController@tienda');

//FIN DE productos de la tienda

//DETALLES DE PRODUCTOS

route::get('detalleProducto/{slug}','productoController@detalleProducto')->name('producto.detalle');
route::get('obtenerGrupo/{slug}','atributoController@grupoCombinacion');
route::get('obtenerCombinacion/{slug}','atributoController@combinacion');
//FIN DETALLES DE PRODUCTOS

//carrito de compra/////

route::match(['get','post'],'/agregarCarrito','productoController@agregarCarrito')->name('agregarCarrito');

route::match(['get','post'],'/carrito','productoController@carrito')->name('carrito');

route::get('/carrito/eliminarProducto/{id}','productoController@eliminarProductoCarrito')->name('carrito.eliminarProducto');

route::get('/carrito/actualizarCantidad/{id}/{cantidad}','productoController@actualizarProductoCarrito');

route::post('carrito/aplicarCupon','cuponController@aplicarDescuento')->name('carrito.aplicarCupon');

route::match(['get','post'],'/lista-deseo','productoController@listaDeseo');
route::get('/lista-deseo/eliminar/{id}','productoController@eliminarlistaDeseo');
//fin carrito de compra/////

//checkout///
    route::get('/obtenerMetodoEnvio/{municipio}','productoController@obtenerMetodoEnvio');
    route::get('/obtenerDireccion','productoController@obtenerDireccion');

    route::get('/checkout/{montoTotal}','productoController@checkout');
    route::get('/obtenerMetodoPagoInternacional','productoController@obtenerMetodoPagoInternacional');
    route::get('/obtenerMetodoPagoNacional','productoController@obtenerMetodoPagoNacional');
//fin checkout///

//pedido//
route::match(['get','post'],'/realizar-pedido','productoController@realizarPedido');

route::get('/gracias','productoController@gracias');
//fin pedido//



//buscar producto
route::get('/buscar-producto','productoController@buscarProducto');
//fin de buscar producto

//Factura pdf
Route::name('factura')->get('/imprimir-factura/{id}', 'pedidoController@pdfFactura');
//fin de factura

//cambiar estado almacen
route::get('/estado-almacen/{id}','pedidoController@cambiarEstadoAlmacen');
//fin de buscar producto/


//filtrar medios de envios por rango
route::get('/rangoEnvio/{id}','metodoEnvioController@rangoEnvio');
//




//eliminar notificaciones
route::get('/t/{id}',function($id){
   
    if(\Auth::user()->rol_id==1){

        foreach (\Auth::user()->comprador->unreadNotifications as $notificacion) {
       
    
         if ($notificacion->id==$id) {
         $notificacion->delete();
         }    
        }
    }

    if(\Auth::user()->rol_id==2){

        foreach (\Auth::user()->tienda->unreadNotifications as $notificacion) {
       
    
         if ($notificacion->id==$id) {
         $notificacion->delete();
         }    
        }
    }
});



