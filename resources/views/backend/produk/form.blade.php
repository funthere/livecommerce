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
		{!! Form::textarea('deskripsi', $produk->deskripsi, ['class' => 'form-control', 'rows' => '3']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('netto', 'Netto (kg)', ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('netto', $produk->netto, ['class' => 'form-control input-mask input-mask-numeric']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('foto', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-6">
		@if($produk->foto)
		<figure>
			<figcaption>Preview :</figcaption>
			<img src="{{ url('asset/produk/'.$produk->foto) }}" class="img-responsive" alt="Foto Produk {{ $produk->produk }}">
		</figure>
			
		<strong>Pilih Foto jika ingin mengganti :</strong>
		@endif
		{!! Form::file('foto', null, ['class' => 'form-control']) !!}
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

@section('script.footer')

<script type="text/javascript">
	$(function(){
		$('#form_{{ $base }}').submit(function (e) {
			// e.preventDefault();
			var form = $(this);
			$('.btn-primary').prop('disabled', true);	
			$('.input-mask').each(function(i, e) {
				var v = $(this).autoNumeric('get');
				$(this).val(v);
			})
			return true;
		})
	});
</script>

@stop