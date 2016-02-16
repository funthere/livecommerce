<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use Form;
use View;
use Carbon\Carbon   ;
use App\Pembayaran as Model;
use App\Pesanan;
use App\MetodePembayaran;
use App\Http\Requests;
use App\Http\Controllers\BackendController;

class PembayaranController extends BackendController
{
    protected $pesanans;

    public function __construct(Model $model, $base = 'pembayaran')
    {
        parent::__construct($model, $base);

        View::share('breadcrumb2Icon', 'fa-money' );

        $pesanans = [];
        foreach(Pesanan::whereHas('customer', function($query) {
            $query->whereNotNull('kode_pesanan');
        })->has('pembayaran', '=', 0)->get() as $pesanan) {
            $pesanans[$pesanan->id] = $pesanan->kode_pesanan.' - '.$pesanan->customer->nama;
        }

        $metode_pembayarans = [];
        foreach(MetodePembayaran::get() as $pembayaran) {
            $metode_pembayaran = $pembayaran->tipe.'  '.$pembayaran->nama_bank.' No. Rek. '.$pembayaran->no_rekening.' a.n. '.$pembayaran->nama_rekening;
            $metode_pembayarans[$pembayaran->id] = $metode_pembayaran;
        }
        
        $this->pesanans = $pesanans;

        View::share('pesanans', $pesanans);
        View::share('metode_pembayarans', $metode_pembayarans);
    }

    public function toggleVerifikasi(Model $model)
    {
        $model->update([
            'verified_at' => $model->getAttribute('verified_at') == null ? Carbon::now() : null,
        ]);

        return redirect()->action($this->baseClass.'@index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = $this->model->findOrFail($id);

        if ($request->has('toggle')) {
            return $this->toggleVerifikasi($model);
        }

        $this->validate($request, $model->rules());

        $updated = $model->update($request->all());

        if ($updated) {
            return redirect('admin/'.$this->base);
        }
        
        return back()->withInputs($request->all());
    }


    protected function processDatatables($datatables)
    {
        return 
            $datatables
                ->editColumn('pesanan_id', function($data) {
                    return $data->pesanan ? $data->pesanan->kode_pesanan.' - '.$data->pesanan->customer->nama : '-';
                })
                ->editColumn('metode_pembayaran_id', function($data) {
                    $bayar = $data->metode_pembayaran;
                    return $bayar ? $bayar->tipe.' '.$bayar->nama_bank. ' a/n '.$bayar->no_rekening.' ('.$bayar->nama_rekening.')' : '-';
                })
                ->editColumn('jumlah', function($data) {
                    return 'Rp'. $data->jumlah_rupiah;
                })
                ->editColumn('bukti', function($data) {
                    return ($data->bukti) ? '<img src="'.asset(Model::FOTO_PATH.$data->bukti).'" title="'.$data->produk.'" style="width: 100px;">' : '';
                })
                ->editColumn('verified_at',  function($data) {
                    return $data->verified_at ? '<span class="label label-success" title="Pembayaran Terverifikasi">Terverifikasi</span> <br> '.$data->verified_at->diffForHumans() : '<span class="label label-warning" title="Belum Terverifikasi">Belum Terverifikasi</span>';
                })
                ->addColumn('menu', function ($data) {
                return
                Form::open(['style' => 'display: inline!important', 'method' => 'put', 'action' => [$this->baseClass.'@update', $data->id]]).'<input type="hidden" name="toggle" value="toggle"><button type="submit" class="btn btn-xs">'.($data->verified_at ? '<i class="fa fa-times"></i> Batal Verifikasi' : '<i class="fa fa-check"></i> Verifikasi').'</button></form>'.
                '<a href="'.action($this->baseClass.'@edit', ['id' => $data->id]).'" class="btn btn-small btn-link"><i class="fa fa-xs fa-pencil"></i> Edit</a> '.
                Form::open(['style' => 'display: inline!important', 'method' => 'delete', 'action' => [$this->baseClass.'@show', $data->id]]).'  <button type="submit" onClick="return confirm(\'Yakin mau menghapus?\');" class="btn btn-small btn-link"><i class="fa fa-xs fa-trash-o"></i> Delete</button></form>';
            })
            ->make(true);
           
    }

    public function store(Request $request)
    {
        $request->merge(['verified_at' => Carbon::now()]);

        return parent::store($request);
    }

    public function edit($id) 
    {
        $model = $this->model->findOrFail($id);

        $pesanan = Pesanan::findOrFail($model->pesanan_id);
        $this->pesanans[$pesanan->id] = $pesanan->kode_pesanan.' - '.$pesanan->customer->nama;
        View::share('pesanans', $this->pesanans);
        
        return parent::edit($id);
    }
}
