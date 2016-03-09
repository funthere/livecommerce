<?php

namespace App\Http\Controllers\Backend;

use View;
use Form;
use Datatables;
use App\Produk;
use App\FotoProduk as Model;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;

class FotoProdukController extends BackendController
{
    protected $produk;

    public function __construct(Model $model, $base = 'foto_produk')
    {
        if (!request()->has('produk_id')) {
            abort('404');
        }

        parent::__construct($model, $base);

        $this->produk = Produk::findOrFail(request()->get('produk_id'));

        View::share('produk', $this->produk);
		View::share('breadcrumb2Icon', 'fa-images' );
        View::share('judul', 'Foto '.$this->produk->produk);
        View::share('deskripsi', 'Daftar Foto Produk');
        View::share('breadcrumb2', $this->produk->produk);
        View::share('breadcrumb3', 'Foto');
    }

    public function datajson()
    {
        $datas = $this->model->select($this->getJsonField())->orderBy('id', 'DESC')->where('produk_id', $this->produk->id);

        if ($dependencies = $this->model->dependencies()) {
            $datas = $datas->with($dependencies);
        }

        $datatables = Datatables::of($datas);
        return $this->processDatatables($datatables);
    }

    protected function processDatatables($datatables)
    {
        return  $datatables
            ->addColumn('menu', function ($data) {
                return
                '<a href="'.action($this->baseClass.'@edit', ['id' => $data->id]).'?produk_id='.$this->produk->id.'" class="btn btn-small btn-link"><i class="fa fa-xs fa-pencil"></i> Edit</a> '.
                Form::open(['style' => 'display: inline!important', 'method' => 'delete', 'url' => action($this->baseClass.'@show', $data->id).'?produk_id='.$this->produk->id]).'  <button type="submit" onClick="return confirm(\'Yakin mau menghapus?\');" class="btn btn-small btn-link"><i class="fa fa-xs fa-trash-o"></i> Delete</button></form>';
            })
            ->make(true);
    }

    public function create()
    {
        $create = parent::create();
        View::share('judul', 'Tambah Metode Pembayaran');
        View::share('deskripsi', 'Untuk menambahkan data Metode Pembayaran');

        return $create;
    }

    public function store(Request $request)
    {
        parent::store($request);

        return redirect('admin/foto_produk?produk_id='.$this->produk->id);
    }

    public function update(Request $request, $id)
    {
        parent::update($request, $id);

        return redirect('admin/foto_produk?produk_id='.$this->produk->id);
    }

    public function destroy($id)
    {
        parent::destroy($id);

        return redirect('admin/foto_produk?produk_id='.$this->produk->id);
    }

    public function edit($id)
    {
        $edit = parent::edit($id);
        View::share('judul', 'Edit Metode Pembayaran');
        View::share('deskripsi', 'Edit data Metode Pembayaran');

        return $edit;
    }
}
