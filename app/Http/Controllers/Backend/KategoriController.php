<?php

namespace App\Http\Controllers\Backend;

use View;
use Form;
use Datatables;
use App\Kategori as Model;
use Illuminate\Http\Request as Request;
use App\Http\Controllers\BackendController;

class KategoriController extends BackendController
{
    public function __construct(Model $model, $base = 'kategori')
    {
        parent::__construct($model, $base);

		View::share('breadcrumb2Icon', 'fa-list' );

    }

}
