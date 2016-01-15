@include('partials.error')

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('pesanan', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::select('pesanan', [null => 'Pilih Pesanan'] + $pesanans, $pembayaran->pesanan_id, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('metode_pembayaran', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::select('metode_pembayaran', [null => 'Pilih Metode Pembayaran'] + $metode_pembayarans, $pembayaran->metode_pembayaran_id, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('jumlah', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('jumlah', $pembayaran->jumlah, ['class' => 'form-control  input-mask input-mask-currency']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('bukti', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-6">
		@if($pembayaran->bukti)
		<figure>
			<figcaption>Preview :</figcaption>
			<img src="{{ url('asset/pembayaran/'.$pembayaran->bukti) }}" class="img-responsive" alt="Foto Produk {{ $metode_pembayaran-> bukti }}">
		</figure>
			
		<strong>Pilih Foto jika ingin mengganti :</strong>
		@endif
		{!! Form::file('bukti', null, ['class' => 'form-control']) !!}
	</div>
</div>