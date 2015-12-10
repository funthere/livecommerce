<?php

namespace App\Http\Controllers\Backend;

use View;
use Form;
use Datatables;
use App\Pesanan as Model;
use App\Http\Requests;
use App\Http\Requests\PesananRequest as Request;
use App\Http\Controllers\BackendController;

class PesananController extends BackendController
{
    public function __construct(Model $model, $base = 'customer')
    {
        parent::__construct($model, $base);
    }
}
