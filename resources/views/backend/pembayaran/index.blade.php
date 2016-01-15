@extends('backend')

@section('content')
<div class="box">
  	<div class="box-body">
		<table class="table datatables table-">
			<thead>
				<th>ID</th>
        		<th>Pesanan</th>
				<th>Metode Pembayaran</th>
				<th>Jumlah</th>
				<th>Bukti Pembayaran</th>
				<th>Status</th>
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
              { data: 0, sortable: false },
              { data: 1, sortable: false },
              { data: 2, sortable: false },
          		{ data: 3, sortable: false },
            ],
        });
    });

</script>	

@stop