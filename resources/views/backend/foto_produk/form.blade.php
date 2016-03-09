@include('partials.error')

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('foto', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		@if($foto_produk->foto)
		Preview :
		<figure style="width: 100%;">
			<img src="{{ url('asset/produk/'.$foto_produk->foto) }}" class="img-responsive" alt="Foto Produk {{ $foto_produk->produk->produk }}">
		</figure>
		<div class="row">&nbsp;</div>
		<strong>Pilih Foto jika ingin mengganti Foto :</strong>
		@endif
		{!! Form::file('foto', null, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('katerangan', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::textarea('keterangan', $foto_produk->keterangan, ['class' => 'form-control', 'rows' => '3']) !!}
	</div>
</div>