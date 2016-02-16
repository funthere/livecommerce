@extends('frontend')

@section('content')

	<section>
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="/">Home</a></li>
				  <li class="active" >Konfirmasi Pembayaran</li>
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
							<br>
							<em><small>{{ ($tes = ! starts_with($pesanan->pembayaran->verified_at, '0000') && $pesanan->pembayaran->verified_at != null && $pesanan->status == 'dibayar') ? 'Lunas' : 'Menunggu Verifikasi'}}</small></em>
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
			        	<div class="login-form"><!--login form-->
							@if($tes)
							<h2>Pesanan ini sudah Lunas</h2>
							@else
			                <h2>Masukkan Detail Pembayaran Anda</h2>
			                {!! Form::open(['url' => 'konfirmasi_pembayaran/'.$pesanan->kode_pesanan, 'files' => true]) !!}
								{!! Form::text('jumlah', null, ['class' => 'form-control', 'placeholder' => 'Jumlah Pembayaran']) !!}
								{!! Form::select('metode_pembayaran', [null => 'Pilih Metode Pembayaran'] + $metode_pembayarans, null, ['class' => 'form-control']) !!}
								<br>
								{!! Form::label('bukti', null, ['class' => 'control-label']) !!}
								{!! Form::file('bukti', null, ['class' => 'form-control']) !!}
			                    <button type="submit" class="btn btn-default">Kirim</button>
			                {!! Form::close() !!}
			                @endif
			            </div><!--/login form-->
					</div>
				</div>
			</div>
	@endif
			<div class="row">				
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="login-form"><!--login form-->
                        <h2>Masukkan Nomor Pesanan Anda</h2>
                        {!! Form::open(['url' => 'konfirmasi_pembayaran']) !!}
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