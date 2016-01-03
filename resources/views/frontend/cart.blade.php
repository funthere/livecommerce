@extends('frontend')


@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="/">Home</a></li>
				  <li class="active">Keranjang Belanja</li>
				</ol>
			</div>
			{!! Form::open() !!}	
				<div class="table-responsive cart_info">
						
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td class="image">Item</td>
								<td class="description"></td>
								<td class="price">Price</td>
								<td class="quantity">Quantity</td>
								<td class="total">Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
						@if(isset($cart) && count($cart->produks))
							@foreach($cart->produks as $cart_produk)
							<tr data-slug="{{ $cart_produk->slug }}" data-weight="{{ $cart_produk->netto * $cart_produk->pivot->quantity }}">
								<td class="cart_product">
									<a href="{{ url( $cart_produk->slug ) }}"><img width="50px" src="{{ asset( 'asset/produk/'. $cart_produk->foto) }}" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="{{ url( $cart_produk->slug ) }}">{{ $cart_produk->produk }}</a></h4>
									<!-- <p>Web ID: 1089772</p> -->
								</td>
								<td class="cart_price">
									<p>Rp {{ $cart_produk->isSale ? $cart_produk->harga_diskon_rupiah : $cart_produk->harga_rupiah }}</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<a class="cart_quantity_up" href="{{ url('tambahkan/'. $cart_produk->slug) }}"> + </a>
										<input class="cart_quantity_input input-mask-numeric" type="text" name="{{ $cart_produk->slug }}" data-v-min="0" data-v-max="{{ $cart_produk->pivot->quantity + $cart_produk->stock }}" value="{{ $cart_produk->pivot->quantity }}" autocomplete="off" size="2">
										<a class="cart_quantity_down" href="{{ url('kurangkan/'. $cart_produk->slug) }}"> - </a>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">Rp {{ number_format($cart_produk->pivot->jumlah , 0, ',' , '.') }}</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="{{ url( 'gak-jadi-beli/'.$cart_produk->slug) }}"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							@endforeach
							<tr>
								<td class="cart_product">
								</td>
								<td class="cart_description">
								</td>
								<td class="cart_price">
								</td>
								<td class="cart_quantity">
									<p class="cart_total_price text-right" style="color: #000;">Total</p>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">Rp {{ number_format($cart->jumlah, 0, ',' , '.') }}</p>
								</td>
								<td class="cart_delete">
								</td>
							</tr>
						@else
							<tr>
								<td colspan="5" class="text-center">
									<h4>Keranjang Anda masih kosong, silakan berbelanja </h4>
									<a href="/" class="btn btn-lg btn-default update">Lihat Katalog</a> 
								</td>
							</tr>
						@endif
						</tbody>
					</table>
				</div>
			@if(isset($cart) && count($cart->produks))
				<div class="row">
					<div class="col-sm-9 heading">
						<p>Setelah melakukan update quantity secara manual, silakan klik tombol update</p>
					</div>
					<div class="col-sm-3">
						<button type="submit" class="btn btn-lg btn-default update pull-right">Update</button>
					</div>
				</div>
			@endif
			</form>
		</div>
	</section> <!--/#cart_items-->

@if(isset($cart) && count($cart->produks))
	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Apa Selanjutnya?</h3>
				<p>Silakan tuliskan tujuan pengiriman dan kami akan menghitung total biayanya.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area row">
						{!! Form::open(['url' => url('cart'), 'id' => 'form-pesanan']) !!}
							<div class="user_info no-margin col-xs-12">
								<label>Nama Penerima</label>
								<input type="text" name="penerima" value="{{ $cart->penerima }}">
							</div>
							<div class="user_info no-margin col-sm-6">
								<label>Email</label>
								<input type="text" name="email" value="{{ $cart->email }}">
							</div>
							<div class="user_info no-margin col-sm-6">
								<label>No. Handphone</label>
								<input type="text" name="no_hp" value="{{ $cart->no_hp }}">
							</div>
							<div class="user_info no-margin col-xs-12">
								<label>Alamat Lengkap</label>
								<textarea name="alamat">{{ $cart->alamat }}</textarea>
							</div>
							<div class="col-sm-4">
								<div class="user_info no-margin">
									<label>Propinsi</label>
									<select id="propinsi" name="propinsi_id" class="form-control no-margin" data-value="{{ $cart->propinsi_id }}">
										<option>Pilih </option>
									</select>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="user_info no-margin">
									<label>Kota / Kabupaten:</label>
									<select id="kota" name="kota_id" class="form-control no-margin" data-value="{{ $cart->kota_id }}">
										<option>Pilih </option>
									</select>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="user_info no-margin">
									<label>Kodepos:</label>
									<input type="text" id="kodepos" name="kodepos" maxlength="5" value="{{ $cart->kodepos }}">
								</div>
							</div>
							<div class="user_info no-margin col-xs-12">
								<button type="submit" class="btn-lg btn-default update pull-right">Simpan</button>
							</div>
								
						{!! Form::close() !!}
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>
								<label>Cara Pengiriman</label>
								<div class="row">
									<select id="pengiriman" class="form-control" style="width: 100%" data-value="{{ $cart->metode_pengiriman }}">
										<option>Pilih Jenis Pengiriman</option>
									</select>
								</div>
							</li>
							<li>Sub Total <span>Rp {{ number_format($cart->jumlah, 0, ',', '.')}}</span></li>
							<!-- <li>Diskon <span>{{ $cart->diskon ? 'Rp '.$cart->diskon : '-' }}</span></li> -->
							<li>Ongkos Kirim <span id="ongkir">{{ $cart->ongkir ? 'Rp '.number_format($cart->ongkir, 0, ',', '.') : 'Free (Ambil di tempat)' }}</span></li>
							<li>Total <span id="total">{{ 'Rp '.number_format($cart->total, 0, ',', '.') }}</span></li>
						</ul>
						<div class="text-right">
							<a class="btn btn-lg btn-default check_out" href="/checkout">Check Out</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endif
@stop

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
		
		$kota = $("#kota").select2({
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
		
		var kota_id = $kota.data('value');
		var $optionKota = $('<option selected>Loading...</option>').val(kota_id);
		$kota.append($optionKota).trigger('change');
		$.getJSON('{{ url('ongkir/kota') }}', {id: kota_id}, function(data) {
			$optionKota.text(data.kota).val(data.id);
			$optionKota.removeData();
			$kota.trigger('change');
		})



		function formatPropinsi (propinsi) {
			if (propinsi.loading) return propinsi.text;
			return propinsi.propinsi;
		}

		function formatPropinsiSelection (propinsi) {
			return propinsi.propinsi || propinsi.text;
		}
		
		$propinsi = $("#propinsi").select2({
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

		var propinsi_id = $propinsi.data('value');
		var $optionPropinsi = $('<option selected>Loading...</option>').val(propinsi_id);
		$propinsi.append($optionPropinsi).trigger('change');
		$.getJSON('{{ url('ongkir/propinsi') }}', {id: propinsi_id}, function(data) {
			$optionPropinsi.text(data.propinsi).val(data.id);
			$optionPropinsi.removeData();
			$propinsi.trigger('change');
		});

		function formatOngkir (cek) {
			if (cek.loading) return cek.text;
			return cek.text;
		}

		function formatOngkirSelection (cek) {
			return cek.text;
		}
		
		$ongkir = $('#ongkir');

		$pengiriman = $("#pengiriman").select2({
			ajax: {
			    url: mainURL +"/cek",
			    dataType: 'json',
			    delay: 250,
			    data: function (params) {
			      var weight = 0;
			      $('[data-weight]').each(function(index, elm) {
			      	weight += Number($(this).data('weight'));
			      });
			      return {
			        weight: weight, // search term
			        kota: $('#kota').val(), // search term
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
			  minimumResultsForSearch: -1,
			  templateResult: formatOngkir, // omitted for brevity, see the source of this page
			  templateSelection: formatOngkirSelection, // omitted for brevity, see the source of this page
			  placeholder: 'Pilih Cara Pengiriman'
		});
		
		var changeOngkir = function (ongkir, ongkir_rupiah) {
			$ongkir.data('ongkir', ongkir).text(ongkir_rupiah);

			$('#form-pesanan').on('submitSuccess', function(evt) {
				$.post('{{ url('cart/info') }}', {metode_pengiriman: $pengiriman.val(), ongkir: $ongkir.data('ongkir')}, function(data) {
					if (data.message == 'ok') $('#total').data('total', data.data.total_rupiah).text(data.data.total_rupiah);
				}, 'json');
			}).submit();
		}
		
		$pengiriman.on('select2:select', function(name, e) {
			var ongkir = name.params.data.cost;
			var ongkir_rupiah = name.params.data.cost_rupiah;
			$ongkir.data('ongkir', ongkir).text(ongkir_rupiah);

			changeOngkir(ongkir, ongkir_rupiah);
		});

		var pengiriman_code = $pengiriman.data('value');
		var $optionPengiriman = $('<option selected>Loading...</option>').val(pengiriman_code);
		$pengiriman.append($optionPengiriman).trigger('change');
		var weight = 0;
	    $('[data-weight]').each(function(index, elm) {
	    	weight += Number($(this).data('weight'));
	    });
		$.getJSON('{{ url('ongkir/cek') }}', {code: pengiriman_code, kota: kota_id, weight: weight}, function(data) {
			$optionPengiriman.text(data.text).val(data.id);
			$optionPengiriman.removeData();
			$pengiriman.trigger('change');

			changeOngkir(data.cost, data.cost_rupiah);
		});

		$('#form-pesanan').submit(function(e) {
			// e.preventDefault();
			var form = $(this);
			form.find('[type=submit]').prop('disabled', true);

			$.post('{{ url('cart/info') }}', form.serialize(), function(data) {
				if (data.message == 'ok') form.trigger('submitSuccess');
				if (data.needReload) return true;
				form.find('[type=submit]').prop('disabled', false);
			}, 'json')

			if (e.originalEvent) return true;
			return false;
		});
		
	</script>
@stop