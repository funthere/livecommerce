<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use View;
use App\Pembayaran as Model;
use App\Pesanan;
use App\MetodePembayaran;
use App\Http\Requests;
use App\Http\Controllers\BackendController;

class PembayaranController extends BackendController
{
    public function __construct(Model $model, $base = 'pembayaran')
    {
        parent::__construct($model, $base);

        View::share('breadcrumb2Icon', 'fa-money' );

        $pesanans = [];
        foreach(Pesanan::whereHas('customer', function($query) {
            $query->whereNotNull('kode_pesanan');
        })->has('pembayarans', '=', 0)->get() as $pesanan) {
            $pesanans[$pesanan->id] = $pesanan->kode_pesanan.' - '.$pesanan->customer->nama;
        }

        $metode_pembayarans = [];
        foreach(MetodePembayaran::get() as $pembayaran) {
            $metode_pembayaran = $pembayaran->tipe.'  '.$pembayaran->nama_bank.' No. Rek. '.$pembayaran->no_rekening.' a.n. '.$pembayaran->nama_rekening;
            $metode_pembayarans[$pembayaran->id] = $metode_pembayaran;
        }
        
        View::share('pesanans', $pesanans);
        View::share('metode_pembayarans', $metode_pembayarans);
    }

    protected function processDatatables($datatables)
    {
        return parent::processDatatables(
            $datatables
                ->editColumn('pesanan_id', function($data) {
                    return $data->pesanan ? $data->pesanan->kode_pesanan.' - '.$data->pesanan->customer->nama : '-';
                })
                ->editColumn('metode_pembayaran_id', function($data) {
                    $bayar = $data->metode_pembayaran;
                    return $bayar ? $bayar->tipe.' '.$bayar->nama_bank. ' a/n '.$bayar->no_rekening.' ('.$bayar->nama_rekening.')' : '-';
                })
            );
    }
}
