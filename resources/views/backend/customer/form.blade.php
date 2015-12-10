@include('partials.error')

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('nama', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('nama', $customer->nama, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('alamat', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::textarea('alamat', $customer->alamat, ['class' => 'form-control', 'rows' => '3']) !!}
	</div>
</div>
<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('kota', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('kota', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('propinsi', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('propinsi', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('kodepos', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('kodepos', null, ['class' => 'form-control']) !!}
	</div>
</div>
