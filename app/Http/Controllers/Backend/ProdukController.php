<?php

namespace App\Http\Controllers\Backend;

use View;
use Form;
use Datatables;
use App\Produk as Model;
use Illuminate\Http\Request as Request;
use App\Http\Controllers\BackendController;

class ProdukController extends BackendController
{
    public function __construct(Model $model, $base = 'produk')
    {
        parent::__construct($model, $base);

		View::share('judul', 'Produk');
		View::share('deskripsi', 'Daftar Produk');

		View::share('breadcrumb1', 'Home Admin');
		View::share('breadcrumb1Icon', 'home' );
		View::share('breadcrumb1Url', url('admin') );

		View::share('breadcrumb2', 'Produk');
		View::share('breadcrumb2Icon', 'male' );
		View::share('breadcrumb2Url', url('admin/produk') );

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
		View::share('judul', 'Tambah Produk');
		View::share('deskripsi', 'Untuk menambahkan data produk');
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
     	View::share('judul', 'Edit Produk');
		View::share('deskripsi', 'Edit data produk');
		View::share('breadcrumb3', 'Edit' );   

		return parent::edit($id);
    }

}
