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

		View::share('judul', 'Customer');
		View::share('deskripsi', 'Daftar Customer');

		View::share('breadcrumb1', 'Home Admin');
		View::share('breadcrumb1Icon', 'home' );
		View::share('breadcrumb1Url', url('admin') );

		View::share('breadcrumb2', 'Customer');
		View::share('breadcrumb2Icon', 'male' );
		View::share('breadcrumb2Url', url('admin/customer') );

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		View::share('breadcrumb3', 'List' );
    	
        return parent::index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		View::share('judul', 'Tambah Customer');
		View::share('deskripsi', 'Untuk menambahkan data customer');
		View::share('breadcrumb3', 'Tambah' );

        return parent::create();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     	View::share('judul', 'Edit Customer');
		View::share('deskripsi', 'Edit data customer');
		View::share('breadcrumb3', 'Edit' );   

		return parent::edit($id);
    }

}
