<?php

namespace App\Http\Controllers\Backend;

use View;
use Form;
use Datatables;
use App\Customer as Model;
use Illuminate\Http\Request as Request;
use App\Http\Controllers\BackendController;

class CustomerController extends BackendController
{
    public function __construct(Model $model, $base = 'customer')
    {
        parent::__construct($model, $base);

		View::share('breadcrumb2Icon', 'fa-male' );

    }


}
