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
          		{ data: 0 }, //id
          		{ data: 22, sortable: false }, // customer
              { data: 24, sortable: false }, //penerima
          		{ data: 23, sortable: false }, // produks
          		{ data: 17 }, //jumlah
          		{ data: 18 }, //ongkir
          		{ data: 20 }, //total
          		{ data: 21 }, // status
          		{ data: 25, sortable: false },
            ],
        });
    });

</script>	

@stop