@extends('frontend')

@section('content')

	<section>
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="/">Home</a></li>
				  <li class="active" >Lacak Pesanan Anda</li>
				</ol>
			</div>
			<div class="row">
				@include('partials.error')
			</div>
	@if(isset($pesanan))		
            <div class="shopper-informations">
				<div class="row">
					<div class="col-sm-5 col-sm-offset-1">
						<h4 class="text-center">
							Detail Pesanan - <strong>{{ $pesanan->kode_pesanan }}</strong>
						</h4>
						<div class="cart-info">
							<div class="user_info">
								<div class="heading">
									<table class="table">
										<tbody>
											@foreach($pesanan->produks as $pesanan_produk)
											<tr>
												<td class="text-right">{{ $pesanan_produk->produk. ' x ' .$pesanan_produk->pivot->quantity }}</td>
												<td class="text-right">{{ 'Rp. '. number_format($pesanan_produk->pivot->jumlah, 0, ',', '.') }}</td>
											</tr>
											@endforeach
											<tr>
												<td class="text-right">Sub Total</td>
												<td class="text-right">{{ $pesanan->jumlah_rupiah }}</td>
											</tr>
											<tr>
												<td class="text-right">{{ $pesanan->ongkir == 0 ? 'Free Ongkir (Ambil di tempat)' : 'Ongkir' }}</td>
												<td class="text-right">{{ $pesanan->ongkir_rupiah }}</td>
											</tr>
											<tr>
												<td class="text-right">Total</td>
												<td class="text-right">{{ $pesanan->total_rupiah }}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-5">
			        	<div class="login-form text-center"><!--login form-->
			                <h2>Status Pesanan Anda adalah :</h2>
			                <a href="#" class="btn btn-lg btn-primary">{{ $status = $pesanan->public_status }}</a>
			            	<br>
			            	<br>
			            	<a href="http://cekresi.com/?noresi={{ $pesanan->no_resi_pengiriman }}" target="_blank" class="text-maroon"><i class="fa fa-search"></i> Cek Status Pengiriman <br> No. Resi {{strtoupper($pesanan->no_resi_pengiriman)}}</a>
			            </div><!--/login form-->
					</div>
				</div>
			</div>
	@endif
			<div class="row">				
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="login-form"><!--login form-->
                        <h2>Masukkan Nomor Pesanan Anda</h2>
                        {!! Form::open(['url' => 'lacak']) !!}
                            <input type="text" name="no_pesanan" placeholder="No Pesanan Anda" />
                            <button type="submit" class="btn btn-default">Cari</button>
                        {!! Form::close() !!}
                    </div>
                </div>
			</div>
			<div class="row">
				<div class="space">&nbsp;</div>
			</div>
		</div>
	</section>

@stop