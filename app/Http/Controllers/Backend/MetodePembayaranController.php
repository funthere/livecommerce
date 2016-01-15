<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use View;
use App\MetodePembayaran as Model;
use App\Http\Requests;
use App\Http\Controllers\BackendController;

class MetodePembayaranController extends BackendController
{
    public function __construct(Model $model, $base = 'metode_pembayaran')
    {
        parent::__construct($model, $base);

        View::share('breadcrumb2Icon', 'fa-credit-card');
        View::share('judul', 'Metode Pembayaran');
        View::share('deskripsi', 'Daftar Metode Pembayaran');
        View::share('breadcrumb2', 'Metode Pembayaran');
    }

    protected function processDatatables($datatables)
    {
        return parent::processDatatables(
            $datatables
                ->editColumn('logo', function ($data) {
                    return ($data->logo) ? '<img src="'.asset(Model::LOGO_PATH.$data->logo).'" title="'.$data->nama_bank.'" style="width: 100px;">' : '';
                })
            );
    }


    public function create()
    {
        $create = parent::create();
        View::share('judul', 'Tambah Metode Pembayaran');
        View::share('deskripsi', 'Untuk menambahkan data Metode Pembayaran');

        return $create;
    }

    public function edit($id)
    {
        $edit = parent::edit($id);
        View::share('judul', 'Edit Metode Pembayaran');
        View::share('deskripsi', 'Edit data Metode Pembayaran');

        return $edit;
    }
}
