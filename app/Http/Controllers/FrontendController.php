<?php

namespace App\Http\Controllers;

use View;
use App\Produk;
use App\Kategori;
use App\Brand;
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
        View::share('produks', $produks);
        View::share('kategoris', $kategoris);
        View::share('brands', $brands);
    }

}
