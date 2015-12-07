<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('frontend.home');
});

Route::group(['prefix' => '/admin', 'namespace' => 'Backend'], function() {

	Route::get('/', function() {
		return view('backend.home');
	});
	Route::resource('brand', 'BrandController');
	Route::resource('customer', 'CustomerController');
	Route::resource('kategori', 'KategoriController');
	Route::resource('produk', 'ProdukController');
	Route::resource('pesanan', 'PesananController');

});
