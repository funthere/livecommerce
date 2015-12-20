<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Produk;
use App\Http\Requests;
use App\Http\Controllers\FrontendController;

class PageController extends FrontendController
{
	public function home()
	{
		$banners = Produk::orderBy('created_at', 'DESC')->take(3)->get();
		return view('frontend.home', compact('banners'));
	}

}
