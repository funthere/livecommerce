@extends('backend')

@section('judul', 'Customer')
@section('deskripsi', 'Daftar Customer')

@section('breadcrumb1', 'Home Admin')
@section('breadcrumb1.icon', 'home' )
@section('breadcrumb1.url', url('admin') )

@section('breadcrumb2', 'Customer')
@section('breadcrumb2.icon', 'male' )
@section('breadcrumb2.url', url('admin/customer') )

@section('breadcrumb3', 'List' )
@section('breadcrumb3.url', 'javascript:;' )


@section('content')
<div class="box">
  	<div class="box-body">
		<table class="table datatables">
			<thead>
				<th>No.</th>
				<th>Nama</th>
				<th>Alamat</th>
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
            ajax: '{{ url('admin/customer/list.json') }}'
        });
    });

</script>	

@stop