<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Produk;
use App\Pesanan;
use App\Http\Requests;
use App\Http\Controllers\FrontendController;

class CheckoutController extends FrontendController
{
    public function index(Request $request)
    {
    	return view('frontend.checkout_administrasi');
    }
}
