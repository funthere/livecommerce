<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use View;
use Carbon\Carbon;
use App\Produk;
use App\Pesanan;
use App\Customer;
use App\MetodePembayaran;
use App\Http\Requests;
use App\Http\Controllers\FrontendController;

class CheckoutController extends FrontendController
{
    protected $transferBanks;

    public function __construct()
    {
        parent::__construct();
        $this->transferBanks = MetodePembayaran::all();
        View::share('transferBanks', $this->transferBanks);
    }

    public function index(Request $request)
    {
      if ($this->cart == null or !count($this->cart->produks)) {
        alert()->error('Maaf, tidak bisa checkout jika cart masih kosong.', 'Isi  Cart lebih dahulu')->autoClose(3600);

        return redirect('cart');
      }

      $not_completed = $this->cart->penerima == null or $this->cart->email == null or $this->cart->no_hp == null or $this->cart->alamat == null or $this->cart->propinsi_id == null or $this->cart->kota_id == null or $this->cart->kode_pos == null;

      if ($not_completed) {
          alert()->error('Maaf, tidak bisa checkout jika data masih kosong.', 'Isi lengkap data Cart lebih dahulu')->autoClose(3600);

          return redirect('cart');
      }

      if ($request->session()->get('without_registration', 'no') == 'no' && $this->customer == null) {
        return view('frontend.checkout_registrasi');
      }

      $request->session()->forget('without_registration');

      return view('frontend.checkout_konfirmasi');

    }

    public function withoutRegistration(Request $request)
    {
      $request->session()->put('without_registration', 'yes');

      return redirect('checkout');   		
    }

    public function getCheckout(Request $request, $kode_pesanan)
    {
      $limitHours = app(Pesanan::class)->getPesananLimitHours();
      $this->cart = Pesanan::with('produks')->with('propinsi')->with('kota')->where('kode_pesanan', $kode_pesanan)->where('created_at', '>=', Carbon::now()->subHours($limitHours))->firstOrFail();
      
      View::share('cart', $this->cart);
      
      return view('frontend.checkout_finish');
    }

   	public function postCheckout(Request $request)
   	{
   	  // ambil semua data form
      $data = $request->all();

      // nama = penerima
      $data['nama'] = $data['penerima'];

      // ambil data customer dari user login atau buat customer baru
      $customer = Customer::create($data);

      // update data customer
      $customer->pesanan()->save($this->cart);

      // buat code pesanan
      $this->cart->generateOrderCode();

      $request->session()->forget('pesanan');

      return redirect()->action('Frontend\CheckoutController@getCheckout', ['kode_pesanan' => $this->cart->kode_pesanan]);
   	}   
}
