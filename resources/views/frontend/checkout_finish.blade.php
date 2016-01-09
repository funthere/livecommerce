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
			<div class="shopper-informations">
					<div class="row">
						<div class="col-sm-6">
							<h4>
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
								<div class="col-xs-4"><h4>Penerima</h4></div>
								<div class="col-xs-8">
                                    <p>{{ $cart->customer->nama }}</p>
                                    <p>{{ $cart->customer->alamat }}</p>
                                    <p>{{ $cart->customer->kota->kota }}</p>
                                    <p>{{ $cart->customer->propinsi->propinsi }}</p>
                                    <p>{{ $cart->customer->kodepos }}</p>
                                </div>
							</div>
                            <div class="row">
								<div class="col-xs-4"><h4>Email</h4></div>
								<div class="col-xs-8">
                                    <h4>
                                        {{ $cart->customer->email }}
                                    </h4>
                                </div>
							</div>
                            <div class="row">
								<div class="col-xs-4"><h4>No. Handphone</h4></div>
								<div class="col-xs-8">
                                    <h4>
                                        {{ $cart->customer->no_hp }}
                                    </h4>
                                </div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</section>
@endsection