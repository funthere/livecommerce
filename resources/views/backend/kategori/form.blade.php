@include('partials.error')

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('kategori', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('kategori', $kategori->kategori, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('slug', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('slug', $kategori->slug, ['class' => 'form-control']) !!}
	</div>
</div>