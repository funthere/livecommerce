@extends('backend')

@section('content')
<div class="box">
  	<div class="box-body">
		<table class="table datatables">
			<thead>
				<th>ID</th>
				<th>Customer</th>
				<th>Penerima</th>
				<th>Produk-produk</th>
				<th>Jumlah</th>
				<th>Diskon</th>
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
          		{ name: 'customer' },
          		{ name: 'penerima' },
          		{ name: 'produks' },
          		{ name: 'jumlah' },
          		{ name: 'diskon' },
          		{ name: 'ongkir' },
          		{ name: 'total' },
          		{ name: 'status' },
          		{ name: 'menu', sortable: false },
            ],
        });
    });

</script>	

@stop