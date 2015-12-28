@extends('frontend')

@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="/">Home</a></li>
				  <li class="active">Check Out</li>
				</ol>
			</div>

			<div class="step-one">
				<h2 class="heading">
					Step2
					<span class="pull-right">Administrasi</span>
				</h2>
			</div>
		</div>
		<div class="container">
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-6">
						<div class="cart-info">
							<div class="user_info">
								<div class="heading">
									tes	
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="shopper-info">
							{!! Form::open(['url' => url('cart'), 'id' => 'form-pesanan']) !!}
								<div class="user_info no-margin col-xs-12">
									<label>Nama Penerima</label>
									<input type="text" name="penerima" >
								</div>
								<div class="user_info no-margin col-sm-6">
									<label>Email</label>
									<input type="text" name="email" >
								</div>
								<div class="user_info no-margin col-sm-6">
									<label>No. Handphone</label>
									<input type="text" name="no_hp" >
								</div>
								<div class="user_info no-margin col-xs-12">
									<label>Alamat Lengkap</label>
									<textarea name="alamat"> </textarea>
								</div>
								<div class="col-sm-4">
									<div class="user_info no-margin">
										<label>Propinsi</label>
										<select id="propinsi" name="propinsi_id" class="form-control no-margin" data->
											<option>Pilih </option>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="user_info no-margin">
										<label>Kota / Kabupaten:</label>
										<select id="kota" name="kota_id" class="form-control no-margin" data->
											<option>Pilih </option>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="user_info no-margin">
										<label>Kodepos:</label>
										<input type="text" id="kodepos" name="kodepos" maxlength="5" >
									</div>
								</div>
								<div class="user_info no-margin col-xs-12">
									<button type="submit" class="btn-lg btn-default update pull-right">Simpan</button>
								</div>
									
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection