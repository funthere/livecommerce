<?php

namespace App\Http\Controllers\Backend;

use View;
use Form;
use Datatables;
use App\Brand;
use App\Kategori;
use App\Produk as Model;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;

class ProdukController extends BackendController
{
    public function __construct(Model $model, $base = 'produk')
    {
        parent::__construct($model, $base);

        View::share('breadcrumb2Icon', 'fa-dropbox' );

        View::share('kategoris', Kategori::lists('kategori', 'id')->toArray());
        View::share('brands', Brand::lists('brand', 'id')->toArray());
    }

    protected function processDatatables($datatables)
    {
        return parent::processDatatables(
            $datatables
                ->editColumn('foto', function($data) {
                    return ($data->foto) ? '<img src="'.asset(Model::FOTO_PATH.$data->foto).'" title="'.$data->produk.'" style="width: 100px;">' : '';
                })
                ->editColumn('kategori_id', function($data) {
                    return $data->kategori != null ? $data->kategori->kategori : '-';
                })
                ->editColumn('brand_id', function($data) {
                    return $data->brand != null ? $data->brand->brand : '-';
                })
                ->editColumn('harga', function($data) {
                    return 'Rp'. $data->harga_rupiah;
                })
                ->editColumn('harga_diskon', function($data) {
                    return 'Rp'. $data->harga_diskon_rupiah;
                })
                ->editColumn('netto', function($data) {
                    return number_format($data->netto , 0, ',' , '.');
                })
                ->editColumn('stock', function($data) {
                    return number_format($data->stock , 0, ',' , '.');
                })
                ->removeColumn('kategori')
                ->removeColumn('brand')
            );    
    }

}
