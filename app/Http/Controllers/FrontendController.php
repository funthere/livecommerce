<?php

namespace App\Http\Controllers;

use View;
use App\Produk;
use App\Kategori;
use App\Brand;
use App\Pesanan;
use App\Customer;
use App\MetodePembayaran;
use Illuminate\Http\Request as Request;
use App\BaseModel as Model;

class FrontendController extends BaseController
{
    protected $produks;
    protected $kategoris;
    protected $brands;
    protected $cart;
    protected $customer;
    protected $transferBanks;

    public function __construct()
    {
        parent::__construct();
        $this->produks = Produk::with('kategori')->latest()->take(3)->get();
        $this->kategoris = Kategori::with(['produks' => function ($query) {
            $query->latest()->take(4);
        }])->get();
        $this->brands = Brand::with('produks')->get();
        $this->cart = request()->hasSession() && request()->session()->has('pesanan') ? Pesanan::with('produks')->with('propinsi')->with('kota')->where('id', request()->session()->get('pesanan'))->first() : null;
        $this->transferBanks = MetodePembayaran::all();

        View::share('produks', $this->produks);
        View::share('kategoris', $this->kategoris);
        View::share('brands', $this->brands);
        View::share('cart', $this->cart);
        View::share('transferBanks', $this->transferBanks);
    }
}
