<?php

namespace App\Http\Controllers\Backend;

use View;
use Form;
use Datatables;
use App\Pesanan as Model;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;

class PesananController extends BackendController
{
    public function __construct(Model $model, $base = 'pesanan')
    {
        parent::__construct($model, $base);
    }

    // protected function processDatatables($datatables)
    // {
    //     $datatables
    //         ->addColumn('customer', function($data) {
    //             return $data->customer->name; 
    //         })->make();
    // }

}
