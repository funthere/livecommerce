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


Route::group(['prefix' => '/', 'namespace' => 'Frontend'], function() {

	Route::get('/', 'PageController@home');

	Route::get('beli/{slug}', 'CartController@tambah');


});

Route::get('tes', function(App\Http\Controllers\BaseController $base) {
	return $base->global_params['nama_toko'];
});

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function() {
    
	Route::get('/', 'PageController@home');
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

	Route::get('setting/data.json', 'ParamController@datajson');
	Route::resource('setting', 'ParamController');

});
