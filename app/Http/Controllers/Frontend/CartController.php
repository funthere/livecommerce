<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Produk;
use App\Pesanan;
use App\Http\Requests;
use App\Http\Controllers\FrontendController;

class CartController extends FrontendController
{

    public function index()
    {
        return view('frontend.cart');
    }

    protected function getCurrentPesanan()
    {
    	$pesanan = request()->session()->has('pesanan') ? Pesanan::with('produks')->find(request()->session()->get('pesanan')) : Pesanan::create();
        return $pesanan;
    }

    
    public function tambahProduk(Request $request, $slug, $quantity = null)
    {
        // dapatkan data quantity atau default = 1
        $quantity = ($quantity != null) ? $quantity : $request->get('quantity', 1);
        // dapatkan data produk
        $produk = Produk::where('slug', $slug)->first();
        // ambil data pesanan dari session atau buat baru
        $pesanan = $this->getCurrentPesanan();
        // tambahkan produk ke dalam pesanan
        $pesanan->tambahProduk($produk, $quantity);

    	// update session 
    	$request->session()->put('pesanan', $pesanan->id);

    	// beri alert
    	alert()->success('Berhasil menambahkan '.$quantity.' produk '.$produk->produk.' ke dalam keranjang. ', 'Update Cart Success');

    	// kembalikan ke halaman sebelumnya	
    	return back();
    }


    public function kurangProduk(Request $request, $slug, $quantity = null)
    {
        // dapatkan data quantity atau default = 1
        $quantity = ($quantity != null) ? $quantity : $request->get('quantity', 1);
        // dapatkan data produk
        $produk = Produk::where('slug', $slug)->first();
        // ambil data pesanan dari session atau buat baru
        $pesanan = $this->getCurrentPesanan();
        // tambahkan produk ke dalam pesanan
        $pesanan->kurangProduk($produk, $quantity);

        // update session 
        $request->session()->put('pesanan', $pesanan->id);

        // beri alert
        alert()->success('Berhasil mengurangi '.$quantity.' produk '.$produk->produk.' dari keranjang. ', 'Update Cart Success');

        // kembalikan ke halaman sebelumnya 
        return back();
    }

    public function hapusProduk(Request $request, $slug)
    {
        return $this->kurang($request, $slug, 'all');
    }
}
