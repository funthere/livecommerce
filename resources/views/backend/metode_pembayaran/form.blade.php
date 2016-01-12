@include('partials.error')

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('metode_pembayaran', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('tipe', $metode_pembayaran->tipe, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('nama_bank', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('nama_bank', $metode_pembayaran->nama_bank, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('no_rekening', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('no_rekening', $metode_pembayaran->no_rekening, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		{!! Form::label('nama_rekening', null, ['class' => 'control-label']) !!}
	</div>
	<div class="col-md-9">
		{!! Form::text('nama_rekening', $metode_pembayaran->nama_rekening, ['class' => 'form-control']) !!}
	</div>
</div>