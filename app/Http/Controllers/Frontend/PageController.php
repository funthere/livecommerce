<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Produk;
use App\Kategori;
use App\Brand;
use App\Http\Requests;
use App\Http\Controllers\FrontendController;

class PageController extends FrontendController
{
    protected $produks;

    public function home()
    {
        $this->produks = Produk::with('kategori')->latest()->take(3)->get();
        view()->share('produks', $this->produks);

		$banners = Produk::orderBy('created_at', 'DESC')->take(3)->get();
		return view('frontend.home', compact('banners'));
	}

    public function shop()
    {
        $produks = Produk::with('kategori')->latest()->paginate(9);
        return view('frontend.shop', compact('produks'));
    }

    public function shopByKategori($slug)
    {
        $kategori = Kategori::where(compact('slug'))->firstOrFail();
        view()->share('judulShop', ucwords($kategori->kategori));
        view()->share('judulProduk', 'Semua '.ucwords($kategori->kategori));
        $produks = $kategori->produks()->latest()->paginate(9);
        return view('frontend.shop', compact('produks'));
    }

    public function shopByBrand($slug)
    {
        $brand = Brand::where(compact('slug'))->firstOrFail();
        view()->share('judulShop', ucwords($brand->brand));
        view()->share('judulProduk', 'Semua Produk '.ucwords($brand->brand));
        $produks = $brand->produks()->latest()->paginate(9);
        return view('frontend.shop', compact('produks'));
    }

    public function shopBySearch($keyword = '')
    {
        view()->share('judulShop', 'Hasil Pencarian dengan keyword : <strong>'.$keyword.'</strong>');
        view()->share('judulProduk', 'Hasil Pencarian');
        view()->share('searchKeyword', $keyword);
        $produks = Produk::with('kategori', 'brand')->where('produk', 'like', '%'.$keyword.'%')->latest()->paginate(9);
        return view('frontend.shop', compact('produks'));
    }

}
