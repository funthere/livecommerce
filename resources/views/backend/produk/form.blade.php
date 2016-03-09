@include('partials.error')

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('produk', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('produk', $produk->produk, ['class' => 'form-control']) !!}
	</div>
</div>


<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('slug', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('slug', $produk->slug, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('kategori', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::select('kategori', [null => 'Pilih Kategori'] + $kategoris, $produk->kategori_id, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('harga', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('harga', $produk->harga, ['class' => 'form-control input-mask input-mask-currency']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('harga_diskon', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('harga_diskon', $produk->harga_diskon, ['class' => 'form-control input-mask input-mask-currency']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('deskripsi', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::textarea('deskripsi', $produk->deskripsi, ['class' => 'form-control', 'rows' => '9', 'style' => 'height: 200px']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('netto', 'Netto (gram)', ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('netto', $produk->netto, ['class' => 'form-control input-mask input-mask-numeric']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('foto', 'Foto Utama', ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		<div class="row">
			<div class="col-sm-9 col-xs-8">
				@if($produk->foto)
				Preview :
				<figure style="width: 100%;">
					<img src="{{ url('asset/produk/'.$produk->foto) }}" class="img-responsive" alt="Foto Produk {{ $produk->produk }}">
				</figure>
				<div class="row">&nbsp;</div>
				<strong>Pilih Foto jika ingin mengganti Foto Utama :</strong>
				@endif
				{!! Form::file('foto', null, ['class' => 'form-control']) !!}
			</div>
			<div class="col-sm-3 col-xs-4">
				<a href="{{ url('admin/foto_produk/create?produk_id='.$produk->id) }}" class="btn btn-success btn-block">Tambah<br>Foto</a>
				@if(count($produk->fotos))
				<br>
				<a href="{{ url('admin/foto_produk?produk_id='.$produk->id) }}">
					<img src="{{ url('asset/produk/'.$produk->fotos[0]->foto) }}" class="img-responsive" alt="{{ $produk->fotos[0]->keterangan }}">
				</a>
				@endif
				@if(count($produk->fotos) > 1)
				<br>
				<a href="{{ url('admin/foto_produk?produk_id='.$produk->id) }}">
					<img src="{{ url('asset/produk/'.$produk->fotos[1]->foto) }}" class="img-responsive" alt="{{ $produk->fotos[1]->keterangan }}">
				</a>
				@endif
				@if(count($produk->fotos) > 2)
				<br>
				<div style="background-image: url({{ url('asset/produk/'.$produk->fotos[2]->foto) }}); background-size: cover">
					<a href="{{ url('admin/foto_produk?produk_id='.$produk->id) }}" class="btn btn-default btn-block btn-lg btn-flat" style="background-color: rgba(34, 34, 34, 0.7); color: #fff">2+</a>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('brand', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::select('brand', [null => 'Pilih Brand'] + $brands, $produk->brand_id, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('stock', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('stock', $produk->stock, ['class' => 'form-control input-mask input-mask-numeric']) !!}
	</div>
</div>
