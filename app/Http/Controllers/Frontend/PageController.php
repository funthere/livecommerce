<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Produk;
use App\Kategori;
use App\Brand;
use App\Pesan;
use App\Pesanan;
use App\Pembayaran;
use App\MetodePembayaran;
use App\Http\Requests;
use App\Http\Controllers\FrontendController;

class PageController extends FrontendController
{
    protected $produks;

    public function home()
    {
        $this->produks = Produk::with('kategori')->latest()->take(3)->get();
        view()->share('produks', $this->produks);

		$banners = Produk::orderBy('created_at', 'DESC')->take(3)->get();
		return view('frontend.home', compact('banners'));
	}

    public function shop()
    {
        $produks = Produk::with('kategori')->latest()->paginate(9);
        return view('frontend.shop', compact('produks'));
    }

    public function shopByKategori($slug)
    {
        $kategori = Kategori::where(compact('slug'))->firstOrFail();
        view()->share('judulShop', ucwords($kategori->kategori));
        view()->share('judulProduk', 'Semua '.ucwords($kategori->kategori));
        $produks = $kategori->produks()->latest()->paginate(9);
        return view('frontend.shop', compact('produks'));
    }

    public function shopByBrand($slug)
    {
        $brand = Brand::where(compact('slug'))->firstOrFail();
        view()->share('judulShop', ucwords($brand->brand));
        view()->share('judulProduk', 'Semua Produk '.ucwords($brand->brand));
        $produks = $brand->produks()->latest()->paginate(9);
        return view('frontend.shop', compact('produks'));
    }

    public function shopBySearch($keyword = '')
    {
        view()->share('judulShop', 'Hasil Pencarian dengan keyword : <strong>'.$keyword.'</strong>');
        view()->share('judulProduk', 'Hasil Pencarian');
        view()->share('searchKeyword', $keyword);
        $produks = Produk::with('kategori', 'brand')->where('produk', 'like', '%'.$keyword.'%')->latest()->paginate(9);
        return view('frontend.shop', compact('produks'));
    }

    public function paymentConfirmation($kode_pesanan = null)
    {
        if ($kode_pesanan == null) {
            return view('frontend.confirmPayment');
        }

        $pesanan = Pesanan::where(compact('kode_pesanan'))->firstOrFail();

        $metode_pembayarans = [];
        foreach(MetodePembayaran::get() as $pembayaran) {
            $metode_pembayaran = $pembayaran->tipe.'  '.$pembayaran->nama_bank.' No. Rek. '.$pembayaran->no_rekening.' a.n. '.$pembayaran->nama_rekening;
            $metode_pembayarans[$pembayaran->id] = $metode_pembayaran;
        }

        view()->share('metode_pembayarans', $metode_pembayarans);
        return view('frontend.confirmPayment', compact('pesanan'));
    }

    public function checkPaymentConfirmation(Request $request)
    {
        $this->validate($request, ['no_pesanan' => 'required']);

        $kodePesanan = $request->no_pesanan;

        $pesanan = Pesanan::where('kode_pesanan', '=', $kodePesanan)->isBaru()->first();

        if ($pesanan == null) {
            return redirect('konfirmasi_pembayaran')->withErrors(['Pesanan tersebut tidak valid atau sudah kadaluarsa']);
        }

        return redirect('konfirmasi_pembayaran/'.$kodePesanan);
    }

    public function postPaymentConfirmation(Request $request, Pembayaran $model, $kode_pesanan)
    {
        $pesanan = Pesanan::where('kode_pesanan', $kode_pesanan)->first();

        if ($pesanan == null) {
            return redirect('konfirmasi_pembayaran')->withErrors(['Pesanan tersebut tidak valid atau sudah kadaluarsa']);
        }

        $request->merge(['pesanan_id' => $pesanan->id]);

        $rules = ['pesanan_id' => 'required', 'metode_pembayaran' => 'required', 'bukti' => 'required', 'jumlah' => 'required|numeric|min:'.$pesanan->total];

        $this->validate($request, $rules);

        $created = $model->create($request->all());

        if ($created) {
            alert()->success('Terima kasih. Kami akan melakukan verifikasi terlebih dahulu. ', 'Konfirmasi Pembayaran berhasil.')->autoClose(3600);

            return redirect('konfirmasi_pembayaran');
        }
    }

    public function tracking($kode_pesanan = null)
    {
        if ($kode_pesanan == null) {
            return view('frontend.tracking');
        }

        $pesanan = Pesanan::where(compact('kode_pesanan'))->firstOrFail();

        return view('frontend.tracking', compact('pesanan'));
    }

    public function checkTracking(Request $request)
    {
        $this->validate($request, ['no_pesanan' => 'required']);

        $kodePesanan = $request->no_pesanan;

        $pesanan = Pesanan::where('kode_pesanan', '=', $kodePesanan)->first();

        if ($pesanan == null) {
            return redirect('lacak')->withErrors(['Pesanan tersebut tidak valid atau sudah kadaluarsa']);
        }

        return redirect('lacak/'.$kodePesanan);
    }

    public function getContact()
    {
        return view('frontend.contact');
    }

    public function postContact(Request $request)
    {
        $pesan = new Pesan();
        
        $request->replace([
            'nama' => $request->get('name'),
            'email' => $request->get('email'),
            'topik' => $request->get('subject'),
            'pesan' => $request->get('message'),
        ]);

        $this->validate($request, $pesan->rules);

        $pesan->fill($request->all());

        $pesan->save();

        // beri alert
        alert()->success('Berhasil mengirimkan pesan', 'Pesan Terkirim')->autoClose(3600);

        // kembalikan ke halaman sebelumnya
        return back();

    }

}
