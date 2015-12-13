<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\FrontendController;

class PageController extends FrontendController
{
	public function home()
	{
		return view('frontend.home');
	}

}
