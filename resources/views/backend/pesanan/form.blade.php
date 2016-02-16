@include('partials.error')

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('no_resi_pengiriman', 'No Resi', ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('no_resi_pengiriman', null, ['class' => 'form-control']) !!}
	</div>
</div>
