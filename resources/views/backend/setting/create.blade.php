@extends('backend')

@section('content')

<div class="row">
	<div class="col-md-7">
		<div class="box">
			<div class="box-body">
				{!! Form::model($model, ['url' => action($baseClass.'@store') ]) !!}
				
				@include('backend.'.$base.'.form')

				<div class="row form-group">
					<div class="col-md-3">&nbsp;</div>
					<div class="col-md-9">
						{!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
						<a href="{{ action($baseClass.'@index') }}" class="btn btn-danger">Batal</a>
					</div>
				</div>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@stop