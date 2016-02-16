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
	
	Route::get('checkout/{kode_pesanan}', 'CheckoutController@getCheckout');

	Route::get('checkout/{kode_pesanan}', 'CheckoutController@getCheckout');

	Route::post('cart', 'CartController@updateCart');

	Route::post('cart/info', 'CartController@updateInfo');

	Route::post('konfirmasi_pembayaran', 'PageController@checkPaymentConfirmation');

	Route::get('konfirmasi_pembayaran/{kode_pesanan?}', 'PageController@paymentConfirmation');

	Route::post('konfirmasi_pembayaran/{kode_pesanan}', 'PageController@postPaymentConfirmation');

	Route::post('lacak', 'PageController@checkTracking');

	Route::get('lacak/{kode_pesanan?}', 'PageController@tracking');
});

Route::get('home', function () {
	if (request()->session()->has('checkout')) {
		request()->session()->forget('checkout');
		return redirect('checkout');
	}

	if (auth()->check() && auth()->user()->is_admin) {
		return redirect('admin');
	}

	return redirect('/');
});

Route::controller('auth', 'Auth\AuthController');
Route::controller('reset', 'Auth\PasswordController');

Route::group(['prefix' => 'shop', 'namespace' => 'Frontend'], function() {

	Route::get('/', 'PageController@shop');

	Route::get('search/{keyword?}', 'PageController@shopBySearch');

	Route::get('{slug}', 'PageController@shopByKategori');

	Route::get('merk/{slug}', 'PageController@shopByBrand');

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
		$key = '41c4c7f98ebf86849fb90c304093f145';
		$origin = '348'; // id kota berdasarkan tabel di database
		$courier = request()->get('courier', 'jne');
		$destination = request()->get('kota');
		$weight = request()->get('weight');

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

		// return $kurirs;

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

				// if ($courier == $kurir->code && $serviceCode == $layanan->service) return $service;

				$data[] = $service;
			}
		}
		return $data;
	});
});

Route::get('search', function () {
	return redirect('shop/search/'.request()->get('keyword', ''));
});

Route::get('tes', function(App\Http\Controllers\BaseController $base) {
	return $base->global_params['nama_toko'];
});

Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'middleware' => 'auth'], function() {
    
	Route::get('/', 'PageController@home');
	Route::post('brand/data.json', 'BrandController@datajson');
	Route::resource('brand', 'BrandController');

	Route::post('customer/data.json', 'CustomerController@datajson');
	Route::resource('customer', 'CustomerController');

	Route::post('kategori/data.json', 'KategoriController@datajson');
	Route::resource('kategori', 'KategoriController');
	
	Route::post('produk/data.json', 'ProdukController@datajson');
	Route::resource('produk', 'ProdukController');
	
	Route::post('pesanan/data.json', 'PesananController@datajson');
	Route::get('pesanan', 'PesananController@index');
	Route::controller('pesanan', 'PesananController');

	Route::post('setting/data.json', 'ParamController@datajson');
	Route::resource('setting', 'ParamController');

	Route::post('pembayaran/data.json', 'PembayaranController@datajson');
	Route::resource('pembayaran', 'PembayaranController');

	Route::post('metode_pembayaran/data.json', 'MetodePembayaranController@datajson');
	Route::resource('metode_pembayaran', 'MetodePembayaranController');

});
