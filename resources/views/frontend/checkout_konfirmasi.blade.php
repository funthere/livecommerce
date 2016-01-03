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
				{!! Form::open(['url' => url('checkout'), 'id' => 'form-pesanan']) !!}
					<div class="row">
						<div class="col-sm-6">
							<h4>
								Keranjang Belanja
								<a href="/cart" class="btn btn-primary pull-right">Edit Keranjang</a>
							</h4>
							<hr>
							<div class="cart-info">
								<div class="user_info">
									<div class="heading">
										<table class="table">
											<tbody>
												@foreach($cart->produks as $cart_produk)
												<tr>
													<td class="text-right">{{ $cart_produk->produk. ' x ' .$cart_produk->pivot->quantity }}</td>
													<td class="text-right">{{ 'Rp. '. number_format($cart_produk->pivot->jumlah, 0, ',', '.') }}</td>
												</tr>
												@endforeach
												<tr>
													<td class="text-right">Sub Total</td>
													<td class="text-right">{{ $cart->jumlah_rupiah }}</td>
												</tr>
												<tr>
													<td class="text-right">Ongkir</td>
													<td class="text-right">{{ $cart->ongkir_rupiah }}</td>
												</tr>
												<tr>
													<td class="text-right">Total</td>
													<td class="text-right">{{ $cart->total_rupiah }}</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="shopper-info">
								<div class="col-xs-12">
									<h4>Data Anda sebagai Pemesan</h4>
									<hr>
								</div>
								<div class="col-xs-12">
									<label>
										<input type="checkbox" id="defaultPemesan">
										Sama dengan data penerima
									</label>
								</div>
								<div class="user_info no-margin col-xs-12">
									<label>Nama Penerima</label>
									<input type="text" name="penerima" data-xvalue="{{ $cart->penerima }}">
								</div>
								<div class="user_info no-margin col-sm-6">
									<label>Email</label>
									<input type="text" name="email" data-xvalue="{{ $cart->email }}">
								</div>
								<div class="user_info no-margin col-sm-6">
									<label>No. Handphone</label>
									<input type="text" name="no_hp" data-xvalue="{{ $cart->no_hp }}">
								</div>
								<div class="user_info no-margin col-xs-12">
									<label>Alamat Lengkap</label>
									<textarea name="alamat" data-xvalue="{{ $cart->alamat }}"></textarea>
								</div>
								<div class="col-sm-4">
									<div class="user_info no-margin">
										<label>Propinsi</label>
										<select id="propinsi" name="propinsi_id" class="form-control no-margin" data-xvalue="{{ $cart->propinsi_id }}">
											<option>Pilih </option>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="user_info no-margin">
										<label>Kota / Kabupaten:</label>
										<select id="kota" name="kota_id" class="form-control no-margin" data-xvalue="{{ $cart->kota_id }}">
											<option>Pilih </option>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="user_info no-margin">
										<label>Kodepos:</label>
										<input type="text" id="kodepos" name="kodepos" maxlength="5" data-xvalue="{{ $cart->kodepos }}">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 text-center">
							<button type="submit" class="btn btn-lg btn-primary">Buat Pesanan</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</section>
@endsection

@section('script.footer')
	<script type="text/javascript">
		var mainURL = '{{ url('ongkir/') }}';
		function formatKabupaten (kota) {
			if (kota.loading) return kota.text;
			return kota.kota;
		}

		function formatKabupatenSelection (kota) {
			return kota.kota || kota.text;
		}
		
		$kota = $("#kota");

		function kotaSelect() {
			$("#kota").select2({
				ajax: {
				    url: mainURL +"/kota",
				    dataType: 'json',
				    delay: 250,
				    data: function (params) {
				      return {
				        q: params.term, // search term
				        prop: $('#propinsi').val(), // search term
				        // page: params.page
				      };
				    },
				    processResults: function (data, params) {
				      // parse the results into the format expected by Select2
				      // since we are using custom formatting functions we do not need to
				      // alter the remote JSON data, except to indicate that infinite
				      // scrolling can be used
				      // params.page = params.page || 1;
				      return {
				        results: data,
				        // pagination: {
				        //   more: (params.page * 30) < data.total_count
				        // }
				      };
				    },
				    cache: true
				  },
				  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
				  // minimumInputLength: 1,
				  templateResult: formatKabupaten, // omitted for brevity, see the source of this page
				  templateSelection: formatKabupatenSelection, // omitted for brevity, see the source of this page
				  placeholder: 'Pilih Kabupaten'
			})
			.on('select2:select', function(e) {
				$('#kodepos').focus();
			});
		}

		kotaSelect();
		
		function initKota() {
			var kota_id = $kota.data('value');
			var $optionKota = $('<option selected>Loading...</option>').val(kota_id);
			$kota.append($optionKota).trigger('change');
			$.getJSON('{{ url('ongkir/kota') }}', {id: kota_id}, function(data) {
				$optionKota.text(data.kota).val(data.id);
				$optionKota.removeData();
				$kota.trigger('change');
			})
		}



		function formatPropinsi (propinsi) {
			if (propinsi.loading) return propinsi.text;
			return propinsi.propinsi;
		}

		function formatPropinsiSelection (propinsi) {
			return propinsi.propinsi || propinsi.text;
		}
		
		$propinsi = $("#propinsi");

		function propinsiSelect() {
			$("#propinsi").select2({
				ajax: {
				    url: mainURL +"/propinsi",
				    dataType: 'json',
				    delay: 250,
				    data: function (params) {
				      return {
				        q: params.term, // search term
				        // page: params.page
				      };
				    },
				    processResults: function (data, params) {
				      // parse the results into the format expected by Select2
				      // since we are using custom formatting functions we do not need to
				      // alter the remote JSON data, except to indicate that infinite
				      // scrolling can be used
				      // params.page = params.page || 1;
				      return {
				        results: data,
				        // pagination: {
				        //   more: (params.page * 30) < data.total_count
				        // }
				      };
				    },
				    cache: true
				  },
				  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
				  // minimumInputLength: 1,
				  // minimumResultsForSearch: -1,
				  templateResult: formatPropinsi, // omitted for brevity, see the source of this page
				  templateSelection: formatPropinsiSelection, // omitted for brevity, see the source of this page
				  placeholder: 'Pilih Propinsi'
			}).on('select2:select', function(e) {
				$('#kota').prop('disabled', false).select2('open');
			});
		}
			
		propinsiSelect();

		function initPropinsi() {
			var propinsi_id = $propinsi.data('value');
			var $optionPropinsi = $('<option selected>Loading...</option>').val(propinsi_id);
			$propinsi.append($optionPropinsi).trigger('change');
			$.getJSON('{{ url('ongkir/propinsi') }}', {id: propinsi_id}, function(data) {
				$optionPropinsi.text(data.propinsi).val(data.id);
				$optionPropinsi.removeData();
				$propinsi.trigger('change');
			});
		}

		function formatOngkir (cek) {
			if (cek.loading) return cek.text;
			return cek.text;
		}

		function formatOngkirSelection (cek) {
			return cek.text;
		}	
		
		$('#defaultPemesan').click(function() {
			if ($(this).is(':Checked')) {
				$('[data-xvalue]').each(function(i, e) {
					var value = $(this).data('xvalue');
					$(this).data('value', value).val(value).prop('readonly', true);
				})
				initPropinsi();
				initKota();
				$propinsi.select2('destroy');
				$kota.select2('destroy');
			} else {
				$('[data-xvalue]').each(function(i, e) {
					$(this).val('').prop('readonly', false);
				});
				propinsiSelect();
				kotaSelect();
			}
			
		})
		
	</script>
@stop