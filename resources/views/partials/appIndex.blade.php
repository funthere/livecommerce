@section('content')
<div class="box">
  	<div class="box-body">
		<table class="table datatables">
			<thead>
				<th>ID</th>
				@foreach($fields as $field)
				<th>{{ $field }}</th>
				@endforeach
				<th>Menu</th>
			</thead>
		</table>  	  	
  	</div><!-- /.box-body -->
</div><!-- /.box-->

@stop

@section('script.footer')
<script type="text/javascript">

	$(function() {
        $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url('admin/'.$base.'/data.json') }}',
            columns: [
          		{ name: 'id' },
            	@foreach($fields as $field)
				{name: '{{ $field }}'},
				@endforeach
          		{ name: 'menu', sortable: false },
            ],
        });
    });

</script>	

@stop