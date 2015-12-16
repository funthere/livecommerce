<?php

namespace App\Http\Controllers;

use View;
use App\Produk;
use App\Kategori;
use App\Brand;
use App\Pesanan;
use Illuminate\Http\Request as Request;
use App\BaseModel as Model;

class FrontendController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $produks = Produk::with('kategori')->latest()->take(3)->get();
        $kategoris = Kategori::with(['produks' => function($query) {
            $query->latest()->take(4);
        }])->get();
        $brands = Brand::with('produks')->get();
        $cart = request()->session()->has('pesanan') ? Pesanan::with('produks')->where('id', request()->session()->get('pesanan'))->first() : null;
        View::share('produks', $produks);
        View::share('kategoris', $kategoris);
        View::share('brands', $brands);
        View::share('cart', $cart);
    }

}
