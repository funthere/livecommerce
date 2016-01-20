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
				<th>Jumlah</th>
				<th>Ongkir</th>
				<th>Total</th>
				<th>Tanggal Kirim</th>
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
            ajax: '{{ action('Backend\PesananController@'.$jsonRequest) }}',
            columns: [
          		{ name: 'id', data: 'id' }, //id
              	{ name: 'kode_pesanan', data: 'kode_pesanan' }, // kode_pesanan
          		{ name: 'customer', data: 'customer', sortable: false }, // customer
              	{ name: 'penerima_lengkap', data: 'penerima_lengkap', sortable: false }, //penerima
          		{ name: 'produks', data: 'produks', sortable: false }, // produks
          		{ name: 'jumlah', data: 'jumlah_rupiah' }, //jumlah
          		{ name: 'ongkir', data: 'ongkir_rupiah' }, //ongkir
          		{ name: 'total', data: 'total_rupiah' }, //total
          		{ name: 'tanggal_pengiriman', data: 'tanggal_pengiriman' }, // status
          		{ name: 'status', data: 'status' }, // status
          		{ name: 'menu', data: 'menu', sortable: false },
            ],
        });
    });

</script>	

@stop