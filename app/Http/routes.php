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

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function() {
    
    View::share('breadcrumbLevel', 3);

	Route::get('/', function() {
		return view('backend.home');
	});
	Route::get('brand/data.json', 'BrandController@datajson');
	Route::resource('brand', 'BrandController');

	Route::get('customer/data.json', 'CustomerController@datajson');
	Route::resource('customer', 'CustomerController');

	Route::get('kategori/data.json', 'KategoriController@datajson');
	Route::resource('kategori', 'KategoriController');
	
	Route::get('produk/data.json', 'ProdukController@datajson');
	Route::resource('produk', 'ProdukController');
	
	Route::get('pesanan/data.json', 'PesananController@datajson');
	Route::resource('pesanan', 'PesananController');

});
