<?php

Route::get('/', function () {
    return view('tienda.index');
});


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');


Route::resource('Comprador', 'compradorController');

Route::get('Contraseña/{comprador}','compradorController@showPassword')->name('Comprador.password');

Route::post('ActualizarContraseña/{comprador}','compradorController@updatePassword')->name('comprador.updatePassword');