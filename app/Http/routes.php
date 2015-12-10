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
	Route::get('brand/list.json', 'BrandController@listjson');
	Route::resource('brand', 'BrandController');

	Route::get('customer/list.json', 'CustomerController@listjson');
	Route::resource('customer', 'CustomerController');

	Route::get('kategori/list.json', 'KategoriController@listjson');
	Route::resource('kategori', 'KategoriController');
	
	Route::get('produk/list.json', 'ProdukController@listjson');
	Route::resource('produk', 'ProdukController');
	
	Route::get('pesanan/list.json', 'PesananController@listjson');
	Route::resource('pesanan', 'PesananController');

});
