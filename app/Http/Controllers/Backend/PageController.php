<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use View;
use App\Http\Requests;
use App\Http\Controllers\BackendController;

class PageController extends BackendController
{
	public function home()
	{
		View::share('judul', 'Home');
		return view('backend.home');
	}

}
