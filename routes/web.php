<?php

Route::get('/', function () {
    return view('tienda.index');
});
Route::get('/adminltee', function () {
    return view('admin.comprador.crear');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
