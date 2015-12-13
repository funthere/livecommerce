@include('partials.error')

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('key', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('key', $setting->key, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('value', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('value', $setting->value, ['class' => 'form-control']) !!}
	</div>
</div>