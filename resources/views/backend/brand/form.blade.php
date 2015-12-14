@include('partials.error')

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('brand', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('brand', $brand->brand, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('slug', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('slug', $brand->slug, ['class' => 'form-control']) !!}
	</div>
</div>