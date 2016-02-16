@extends('backend')

@section('content')
<div class="box">
  	<div class="box-body">
		<table class="table datatables table-">
			<thead>
				<th>ID</th>
        <th>Kode Pesanan</th>
				<th>Customer</th>
				<th>Penerima</th>
				<th>Produk-produk</th>
				<th>Total</th>
				<th>Pengiriman</th>
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
            ajax: {url: '{{ action('Backend\PesananController@'.$jsonRequest) }}', type: 'POST'},
            columns: [
          		{ name: 'id', data: 'id' }, //id
              { name: 'kode_pesanan', data: 'kode_pesanan' }, // kode_pesanan
          		{ name: 'customer', data: 'customer', sortable: false, searchable: false}, // customer
              { name: 'penerima_lengkap', data: 'penerima_lengkap', sortable: false, searchable: false }, //penerima
          		{ name: 'produks', data: 'produks', sortable: false, searchable: false }, // produks
          		{ name: 'total', data: 'total_rupiah', sortable: false, searchable: false }, //total
          		{ name: 'tanggal_pengiriman', data: 'tanggal_pengiriman' }, // status
          		{ name: 'status', data: 'status', sortable: false, searchable: false }, // status
          		{ name: 'menu', data: 'menu', sortable: false, searchable: false },
            ],
        });
    });

</script>	

@stop