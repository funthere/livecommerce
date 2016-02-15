<?php

namespace App\Http\Controllers\Backend;

use View;
use Form;
use Carbon\Carbon;
use Datatables;
use App\Pesanan as Model;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;

class PesananController extends BackendController
{
    public function __construct(Model $model, $base = 'pesanan')
    {
        parent::__construct($model, $base);
        View::share('breadcrumb2Icon', 'fa-shopping-cart');
    }

    protected function getJsonField()
    {
        return '*';
    }

    protected function getInitData()
    {
        return $this->model->select($this->getJsonField())->where('kode_pesanan', '<>', '')->orderBy('id', 'DESC');
    }

    protected function processDatatables($datatables)
    {
        return $datatables
            ->addColumn('customer', function ($data) {
                $customer = $data['customer'];
                if (empty($customer)) return '';  
                $text = $customer['nama'].'<br>';
                $text .= $customer['alamat'].'<br>';
                $text .= $customer['kota']['kota'].'<br>';
                $text .= $customer['propinsi']['propinsi'].'<br>';
                $text .= $customer['kodepos'].'<br>';
                $text .= $customer['no_hp'].'<br>';
                $text .= $customer['email'].'<br>';
                return $text;
            })
            ->addColumn('penerima_lengkap', function ($data) {
                if (empty($data['penerima'])) return '';  
                $text = $data['penerima'].'<br>';
                $text .= $data['alamat'].'<br>';
                $text .= $data['kota']['kota'].'<br>';
                $text .= $data['propinsi']['propinsi'].'<br>';
                $text .= $data['kodepos'].'<br>';
                $text .= $data['no_hp'].'<br>';
                $text .= $data['email'].'<br>';
                return $text;
            })
            ->addColumn('produks', function ($data) {
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
            ->editColumn('tanggal_pengiriman', function($data) {
                return ! starts_with($data->tanggal_pengiriman, '0000') ? $data->tanggal_pengiriman : '-';  
            })
            ->addColumn('status', function ($data) {
                $status = $data->status;

                if ($status == 'berhasil') return '<span class="label label-info" title="Berhasil">Berhasil</span>';
                if ($status == 'batal') return '<span class="label label-danger" title="Batal">Batal</span>';
                if ($status == 'dibayar') {
                    return (! starts_with($data->pembayaran->verified_at, '0000') && $data->pembayaran->verified_at != null) ? '<span class="label label-success" title="Pembayaran Terverifikasi">Terverifikasi</span>' : '<span class="label label-warning" title="Sudah Dibayar">Dibayar</span>';
                }
                if ($status == 'baru') return '<span class="label bg-navy" title="Baru">Baru</span>';
            })
            ->addColumn('menu', function ($data) {
                return 'menu';
            })
            
            ->make(true);
    }

    public function getDataJson()
    {
        $datas = $this->getInitData();

        if ($dependencies = $this->model->dependencies()) {
            $datas = $datas->with($dependencies);
        }

        $datatables = Datatables::of($datas);
        return $this->processDatatables($datatables);
    }

    public function getBaruJson()
    {
        $datas = $this->getInitData();

        $datas->isBaru();

        if ($dependencies = $this->model->dependencies()) {
            $datas = $datas->with($dependencies);
        }

        $datatables = Datatables::of($datas);
        return $this->processDatatables($datatables);
    }

    public function getDibayarJson()
    {
        $datas = $this->getInitData();

        $datas->has('pembayaran');

        if ($dependencies = $this->model->dependencies()) {
            $datas = $datas->with($dependencies);
        }

        $datatables = Datatables::of($datas);
        return $this->processDatatables($datatables);
    }

    public function getBerhasilJson()
    {
        $datas = $this->getInitData();

        $datas->has('pembayaran')->whereNotNull('no_resi_pengiriman');

        if ($dependencies = $this->model->dependencies()) {
            $datas = $datas->with($dependencies);
        }

        $datatables = Datatables::of($datas);
        return $this->processDatatables($datatables);
    }

    public function getBatalJson()
    {
        $datas = $this->getInitData();

        $datas->isBatal();

        if ($dependencies = $this->model->dependencies()) {
            $datas = $datas->with($dependencies);
        }

        $datatables = Datatables::of($datas);
        return $this->processDatatables($datatables);
    }

    public function getBaru()
    {
        View::share('judul', 'Pesanan Baru');
        View::share('deskripsi', 'Daftar Pesanan Baru');
        View::share('breadcrumb3', 'Baru');
        return view("backend.{$this->base}.baru");
    }

    public function getDibayar()
    {
        View::share('judul', 'Pesanan Sudah Dibayar');
        View::share('deskripsi', 'Daftar Pesanan yang Sudah Dibayar');
        View::share('breadcrumb3', 'Sudah Dibayar');
        return view("backend.{$this->base}.dibayar");
    }

    public function getBerhasil()
    {
        View::share('judul', 'Pesanan Berhasil');
        View::share('deskripsi', 'Daftar Pesanan yang Berhasil');
        View::share('breadcrumb3', 'Berhasil');
        return view("backend.{$this->base}.berhasil");
    }

    public function getBatal()
    {
        View::share('judul', 'Pesanan Batal');
        View::share('deskripsi', 'Daftar Pesanan yang Batal');
        View::share('breadcrumb3', 'Batal');
        return view("backend.{$this->base}.batal");
    }


}
