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

    protected function processDatatables($datatables)
    {
        return $datatables
            ->addColumn('customer', function($data) {
                $customer = $data['customer'];
                $text = $customer['nama'].'<br>';
                $text .= $customer['alamat'].'<br>';
                $text .= $customer['kota']['kota'].'<br>';
                $text .= $customer['propinsi']['propinsi'].'<br>';
                $text .= $customer['kodepos'].'<br>';
                $text .= $customer['no_hp'].'<br>';
                $text .= $customer['email'].'<br>';
                return $text;
            })
            ->addColumn('penerima_lengkap', function($data) {
                $text = $data['penerima'].'<br>';
                $text .= $data['alamat'].'<br>';
                $text .= $data['kota']['kota'].'<br>';
                $text .= $data['propinsi']['propinsi'].'<br>';
                $text .= $data['kodepos'].'<br>';
                $text .= $data['no_hp'].'<br>';
                $text .= $data['email'].'<br>';
                return $text;
            })
            ->addColumn('produks', function($data) {
                $produks = $data->produks;
                // dd($produks);
                $text = '';
                foreach ($produks as $produk) {
                    $text .= $produk->produk.'<br>';                    
                    $text .= $produk->pivot->quantity.' x ';                    
                    $text .= $produk->pivot->harga.'<br>';                    
                }
                return $text;
            })
            ->addColumn('status', function($data) {
                return 'status';
            })
            ->addColumn('menu', function($data) {
                return 'menu';
            })
            
            ->make();
    }

}
