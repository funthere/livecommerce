<?php

namespace App\Http\Controllers;

use View;
use App\Produk;
use App\Kategori;
use App\Brand;
use App\Pesanan;
use App\Customer;
use Illuminate\Http\Request as Request;
use App\BaseModel as Model;

class FrontendController extends BaseController
{
    protected $produks;
    protected $kategoris;
    protected $brands;
    protected $cart;
    protected $customer;

    public function __construct()
    {
        parent::__construct();
        $this->produks = $produks = Produk::with('kategori')->latest()->take(3)->get();
        $this->kategoris = $kategoris = Kategori::with(['produks' => function($query) {
            $query->latest()->take(4);
        }])->get();
        $this->brands = $brands = Brand::with('produks')->get();
        $this->cart = $cart = request()->session()->has('pesanan') ? Pesanan::with('produks')->where('id', request()->session()->get('pesanan'))->first() : null;
        $this->customer = $customer = $this->cart->customer;
        View::share('produks', $produks);
        View::share('kategoris', $kategoris);
        View::share('brands', $brands);
        View::share('cart', $cart);
        View::share('customer', $customer);
    }

}
