@section('content')
<div class="box">
  	<div class="box-body">
		<table class="table datatables">
			<thead>
				<th>ID</th>
        @foreach($fields as $field => $title)
        @if(!is_array($title))
        <th>{{ $title }}</th>
        @else
        <th>{{ $title['title'] }}</th>
        @endif
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
            ajax: {url: '{{ url('admin/'.$base.'/data.json') }}'+location.search, type: 'POST'},
            columns: [
              { name: 'id', data: 'id' },
            @foreach($fields as $field => $title)
              @if(!is_array($title))
              {name: '{{ $field }}', data: '{{ $field }}'},
              @else
    				  {name: '{{ $field }}', data: '{{ $field }}', sortable: {{ $title['sortable'] }}, searchable: {{ $title['searchable'] }}},
              @endif
    				@endforeach
          		{ name: 'menu', data: 'menu', sortable: false },
            ],
        });
    });

</script>	

@stop