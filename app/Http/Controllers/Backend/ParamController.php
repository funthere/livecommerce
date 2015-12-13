<?php

namespace App\Http\Controllers\Backend;

use View;
use Form;
use Datatables;
use App\Param as Model;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;

class ParamController extends BackendController
{
    public function __construct(Model $model, $base = 'setting')
    {
        parent::__construct($model, $base);
 
        View::share('breadcrumb2Icon', 'fa-cog' );
    }
}
