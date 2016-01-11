@extends('backend')

@section('content')
<div class="box">
  	<div class="box-body">
		<table class="table datatables table-">
			<thead>
				<th>ID</th>
				<th>Customer</th>
				<th>Penerima</th>
				<th>Produk-produk</th>
				<th>Jumlah</th>
				<th>Ongkir</th>
				<th>Total</th>
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
          		{ name: 'id' },
          		{ name: 'customer', data: 17, sortable: false },
          		{ name: 'penerima_lengkap', data: 20, sortable: false },
          		{ name: 'produks', data: 18, sortable: false },
          		{ name: 'jumlah', data: 14 },
          		{ name: 'ongkir', data: 9 },
          		{ name: 'total', data: 16 },
          		{ name: 'status', data: 21 },
          		{ name: 'menu', data: 22, sortable: false },
            ],
        });
    });

</script>	

@stop