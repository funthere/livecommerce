<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use View;
use App\Pesan as Model;
use App\Http\Controllers\BackendController;

class PesanController extends BackendController
{
    public function __construct(Model $model, $base = 'pesan')
    {
        parent::__construct($model, $base);

        View::share('breadcrumb2Icon', 'fa-envelope-o');

    }

    protected function processDatatables($datatables)
    {
        return  $datatables
            ->addColumn('menu', function ($data) {
                return '-'; 
            })       
            ->make(true);
    }
}
