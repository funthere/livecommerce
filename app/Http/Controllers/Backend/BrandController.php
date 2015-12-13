<?php

namespace App\Http\Controllers\Backend;

use View;
use Form;
use Datatables;
use App\Brand as Model;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;

class BrandController extends BackendController
{
    public function __construct(Model $model, $base = 'brand')
    {
        parent::__construct($model, $base);

		View::share('breadcrumb2Icon', 'fa-tag' );

    }

}
