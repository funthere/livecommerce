@section('content')
<div class="box">
  	<div class="box-body">
		<table class="table datatables">
			<thead>
				<th>ID</th>
        @foreach($fields as $field => $title)
        <th>{{ $title }}</th>
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
              { name: 'id', data: 'id' },
            @foreach($fields as $field => $title)
    				  {name: '{{ $field }}', data: '{{ $field }}'},
    				@endforeach
          		{ name: 'menu', data: 'menu', sortable: false },
            ],
        });
    });

</script>	

@stop