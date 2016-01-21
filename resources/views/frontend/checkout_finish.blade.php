@extends('frontend')

@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="/">Home</a></li>
				  <li class="active">Check Out</li>
				</ol>
			</div>

			<div class="step-one">
				<h2 class="heading">
					Step3
					<span class="pull-right">Pesanan Selesai</span>
				</h2>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-xs-4"><h4>No. Pesanan</h4></div>
						<div class="col-xs-8">
                            <h4>
                                {{ $cart->kode_pesanan }}
                                <small>(Silakan dicatat)</small>
                            </h4>
                        </div>
					</div>
                    <hr> 
                    <div class="row">
						<div class="col-xs-4">Pemesan</div>
						<div class="col-xs-8">
                            <p class="lead">{{ $cart->customer->nama }}</p>
                            <p>{{ $cart->customer->alamat }}</p>
                            <p>{{ $cart->customer->kota->kota }}</p>
                            <p>{{ $cart->customer->propinsi->propinsi }}</p>
                            <p>{{ $cart->customer->kodepos }}</p>
                        </div>
					</div>
                    <div class="row">
						<div class="col-xs-4">Email</div>
						<div class="col-xs-8"> <p>{{ $cart->customer->email }}</p> </div>
					</div>
                    <div class="row">
						<div class="col-xs-4">No. Handphone	</div>
						<div class="col-xs-8"> <p>{{ $cart->customer->no_hp }}</p> </div>
					</div>
					<div class="row">
						<hr>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<div class="col-xs-12"><h4>Dikirim ke (Penerima)</h4></div>
					</div>
					<hr>
                    <div class="row">
						<div class="col-xs-4">Penerima</div>
						<div class="col-xs-8">
                            <p class="lead">{{ $cart->penerima }}</p>
                            <p>{{ $cart->alamat }}</p>
                            <p>{{ $cart->kota->kota }}</p>
                            <p>{{ $cart->propinsi->propinsi }}</p>
                            <p>{{ $cart->kodepos }}</p>
                        </div>
					</div>
					 <div class="row">
						<div class="col-xs-4">Email</div>
						<div class="col-xs-8"> <p>{{ $cart->email }}</p> </div>
					</div>
                    <div class="row">
						<div class="col-xs-4">No. Handphone	</div>
						<div class="col-xs-8"> <p>{{ $cart->no_hp }}</p> </div>
					</div>
					<div class="row">
						<hr>
					</div>
				</div>
			</div>
			<div class="shopper-informations">
					<div class="row">
						<div class="col-sm-8 col-md-offset-2">
							<h4 class="text-center">
								Keranjang Belanja
							</h4>
							<div class="cart-info">
								<div class="user_info">
									<div class="heading">
										<table class="table">
											<tbody>
												@foreach($cart->produks as $cart_produk)
												<tr>
													<td class="text-right">{{ $cart_produk->produk. ' x ' .$cart_produk->pivot->quantity }}</td>
													<td class="text-right">{{ 'Rp. '. number_format($cart_produk->pivot->jumlah, 0, ',', '.') }}</td>
												</tr>
												@endforeach
												<tr>
													<td class="text-right">Sub Total</td>
													<td class="text-right">{{ $cart->jumlah_rupiah }}</td>
												</tr>
												<tr>
													<td class="text-right">{{ $cart->ongkir == 0 ? 'Free Ongkir (Ambil di tempat)' : 'Ongkir' }}</td>
													<td class="text-right">{{ $cart->ongkir_rupiah }}</td>
												</tr>
												<tr>
													<td class="text-right">Total</td>
													<td class="text-right">{{ $cart->total_rupiah }}</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
			<div class="shopper-informations">
					<div class="row">
						<div class="col-sm-8 col-md-offset-2">
							<h4 class="text-center">
								Cara Pembayaran
							</h4>
							<p class="text-center">
								Silakan melakukan pembayaran dengan cara transfer ke salah satu bank berikut :
							</p>
							<div class="cart-info">
								<div class="user_info">
									<div class="heading">
										<table class="table">
											<thead>
												<tr>
													<th>Pilih Salah Satu</th>
													<th>Nama Bank</th>
													<th>No. Rekening</th>
													<th>Nama Rekening</th>
												</tr>
											</thead>
											<tbody>
												@foreach($transferBanks as $bank)
												<tr>
													<td><img src="{{ asset('/asset/metode_pembayaran/'.$bank->logo) }}" style="width: 100px"></td>
													<td>{{ $bank->nama_bank }}</td>
													<td>{{ $bank->no_rekening }}</td>
													<td>{{ $bank->nama_rekening }}</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<p class="text-center">
								Gunakan 4 digit terakhir Kode Pesanan Anda <span class="lead">({{ $cart->kode_pesanan }})</span> sebagai Nomor Referensi. <br>
								Setelah melakukan pembayaran segera lakukan konfirmasi pembayaran. <br>
								<a href="/konfirmasi_pembayaran/{{ $cart->kode_pesanan }}" class="btn btn-primary">Konfirmasi Pembayaran</a>
							</p>
							<p class="text-center">
								Kami tunggu pembayaran Anda maksimal {{ $cart->created_at->addHours(isset($global_params['lama_jam_pesanan_baru']) ? $global_params['lama_jam_pesanan_baru'] : '24')->diffInHours() }} jam lagi atau pesanan dianggap batal.
							</p>
						</div>
					</div>
			</div>
		</div>
	</section>
@endsection