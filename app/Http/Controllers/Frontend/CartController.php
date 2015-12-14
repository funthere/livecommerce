<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Produk;
use App\Pesanan;
use App\Http\Requests;
use App\Http\Controllers\FrontendController;

class CartController extends FrontendController
{
    
    public function tambah(Request $request, $slug)
    {
    	// dapatkan data quantity atau default = 1
    	$quantity = $request->get('quantity', 1);
    	// dapatkan data produk
    	$produk = Produk::where('slug', $slug)->first();
    	// ambil data pesanan dari session atau buat baru
    	$pesanan = $request->session()->has('pesanan') ? Pesanan::find($request->session()->get('pesanan')) : Pesanan::create();
       	// masukkan data pesanan detail
       	// jika produk yang sama sudah ada ambil quantity nya
       	foreach ($pesanan->produks as $produk_pesanan) {
       		if ($produk_pesanan->pivot->produk_id == $produk->id) 
       		{
       			$quantity += $produk_pesanan->pivot->quantity;
       			$pesanan->produks()->detach($produk->	id);
       		}
       	}

       	$detail = [
       		'produk' => $produk->produk,
            'harga' => $produk->isSale ? $produk->harga_diskon : $produk->harga,
            'quantity' => $quantity,
            'diskon' => $produk->isSale ? $produk->harga - $produk->harga_diskon : 0,
       	];
       	// hitung jumlah
        $detail['jumlah'] = $detail['harga'] * $detail['quantity'] - $detail['diskon'];
       	// masukkan ke pesanan;
    	$pesanan->produks()->attach($produk->id, $detail);

    	// update session 
    	$request->session()->put('pesanan', $pesanan->id);

    	// beri alert
    	alert()->success('Berhasil menambahkan produk '.$produk->produk.' ke dalam keranjang. ', 'Update Cart Success');

    	// kembalikan ke halaman sebelumnya	
    	return back();
    }
}
