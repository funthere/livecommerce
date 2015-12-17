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
						@if(isset($cart))
						@if(count($cart->produks))
							@foreach($cart->produks as $cart_produk)
							<tr>
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
						@endif
						</tbody>
					</table>
				</div>
			@if(count($cart->produks))
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

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Apa Selanjutnya?</h3>
				<p>Silakan tuliskan tujuan pengiriman dan kami akan menghitung total biayanya.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Sub Total <span>Rp {{ $cart->jumlah}}</span></li>
							<li>Diskon <span>{{ $cart->diskon ? 'Rp '.$cart->diskon : '-' }}</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>Rp {{ $cart->total }}</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@stop