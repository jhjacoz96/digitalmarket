<?php

Route::get('/', function () {
    return view('tienda.index');
});
Route::get('/adminltee', function () {
    return view('admin.comprador.crear');
});
Route::get('/logeo', function () {
    return view('auth.login');
});
Route::get('/registrar', function () {
    return view('auth.register');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
