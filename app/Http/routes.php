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

	Route::get('beli/{slug}', 'CartController@tambahProduk');

	Route::get('tambahkan/{slug}/{quantity?}', 'CartController@tambahProduk');

	Route::get('gak-jadi-beli/{slug}', 'CartController@hapusProduk');

	Route::get('kurangkan/{slug}/{quantity?}', 'CartController@kurangProduk');

	Route::get('cart', 'CartController@index');

	Route::get('checkout', 'CheckoutController@index');

	Route::get('checkout/without_registration', 'CheckoutController@withoutRegistration');

	Route::post('checkout','CheckoutController@postCheckout');

	Route::post('cart', 'CartController@updateCart');

	Route::post('cart/info', 'CartController@updateInfo');

});

Route::group(['prefix' => 'ongkir'], function() {
	Route::get('propinsi', function() {
		$id = request()->get('id', null);
		if ($id !== null && null != $propinsi = \App\Propinsi::find($id)) return $propinsi;
		$q = request()->get('q', '');
		$data = \App\Propinsi::where('propinsi', 'like', '%'.$q.'%')->get();
		return $data;
	});

	Route::get('kota', function() {
		$id = request()->get('id', null);
		if ($id !== null && null != $kota = \App\Kota::find($id)) return $kota;
		$q = request()->get('q', '');
		$propinsi_id = request()->get('prop', '%');
		$data = \App\Kota::where('propinsi_id', 'like', $propinsi_id)->where('kota', 'like', '%'.$q.'%')->get();
		return $data;
	});

	Route::get('cek', function() {
		$key = '4243a697cd6621c821724dcc78c25a4b';
		$origin = '348';
		$courier = request()->get('courier', 'all');
		$destination = request()->get('kota');
		$weight = request()->get('weight') * 1000;

		$cekCode = request()->get('code', null);
		if ($cekCode != null) {
			$codes = explode('-', $cekCode);
			$courier = $codes[0];
			$serviceCode = $codes[1];
		}

		$client = new GuzzleHttp\Client();
		$res = $client->request('POST', 'http://api.rajaongkir.com/starter/cost', [
				    'headers' => ['key' => $key, 'content-type' => 'application/x-www-form-urlencoded'],
				    'form_params' => compact('origin', 'destination', 'weight', 'courier'),
				]);

		$html = $res->getBody();

		$result = json_decode($html);

		if (!isset($result->rajaongkir->results) or $result->rajaongkir->results == null) return [];

		$kurirs = $result->rajaongkir->results;

		$data = [];

		foreach ($kurirs as $kurir) 
		{
			foreach ($kurir->costs as $layanan) 
			{
				if (!isset($layanan->cost) or count($layanan->cost) == 0) continue; 

				$cost = $layanan->cost; 

				$service = [];

				$service['text'] = strtoupper($kurir->code) . ' ' . $layanan->service . (!empty($etd = $layanan->cost[0]->etd) ? ' ('.$etd.' hari) ' : ''). ' - Rp '.number_format($layanan->cost[0]->value, 0, ',', '.');

				$service['id'] = $kurir->code.'-'.$layanan->service;

				$service['cost'] = $layanan->cost[0]->value;


				$service['cost_rupiah'] = 'Rp '.number_format($layanan->cost[0]->value, 0, ',', '.');

				if ($courier == $kurir->code && $serviceCode == $layanan->service) return $service;

				$data[] = $service;
			}
		}
		return $data;
	});
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
