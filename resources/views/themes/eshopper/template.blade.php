<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | {{ $global_params['nama_toko'] or 'nama_toko' }}</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/select2/select2.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/select2/select2-bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/sweetalert/dist/sweetalert.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ asset('images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/ico/apple-touch-icon-57-precomposed.png') }}">

</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="tel:{{ $global_params['telepon'] or 'telepon' }}"><i class="fa fa-phone"></i> {{ $global_params['telepon'] or 'telepon' }}</a></li>
								<li><a href="mailto:{{ $global_params['email'] or 'email' }}"><i class="fa fa-envelope"></i> {{ $global_params['email'] or 'email' }}</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								@if(isset($global_params['facebook']))<li><a href="{{ $global_params['facebook'] }}"><i class="fa fa-facebook"></i></a></li>@endif
								@if(isset($global_params['twitter']))<li><a href="{{ $global_params['twitter'] }}"><i class="fa fa-twitter"></i></a></li>@endif
								@if(isset($global_params['linkedin']))<li><a href="{{ $global_params['linkedin'] }}"><i class="fa fa-linkedin"></i></a></li>@endif
								@if(isset($global_params['dribbble']))<li><a href="{{ $global_params['dribbble'] }}"><i class="fa fa-dribbble"></i></a></li>@endif
								@if(isset($global_params['google-plus']))<li><a href="{{ $global_params['google-plus'] }}"><i class="fa fa-google-plus"></i></a></li>@endif
								<li><a href="#"><i class="fa fa-user"></i> Login / Sign Up</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="/"><h2 class="heading">{{ $global_params['nama_toko'] or 'nama_toko' }}</h2></a>
						</div>
						<!-- <div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div> -->
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<!-- <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li> -->
								<li><a href="login.html"><i class="fa fa-map-marker"></i> Lacak</a></li>
								<li><a href="login.html"><i class="fa fa-credit-card"></i> Konfirmasi Bayar</a></li>
								<li><a href="/checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="/cart"><i class="fa fa-shopping-cart"></i> Cart
									@if($cart)
										({{ count($cart->produks) }} item | {{ $cart->total_rupiah }})
									@endif
								</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="/" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Pilih Kategori<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                    @if(isset($kategoris))
                                    @foreach($kategoris as $kategori)
                                        <li><a href="{{ $kategori->kategori }}">{{ $kategori->kategori }}</a></li>
                                    @endforeach
                                    @endif
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Pilih Merk<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                    @if(isset($brands))
                                    @foreach($brands as $brand)
                                        <li><a href="{{ $brand->brand }}">{{ $brand->brand }}</a></li>
                                    @endforeach
                                    @endif
                                    </ul>
                                </li> 
								<li><a href="contact-us.html">Hubungi Kami</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	@yield('content')
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2>{{ $global_params['nama_toko'] or 'nama_toko'}}</h2>
							<p>{{ $global_params['deskripsi_toko'] or 'deskripsi_toko'}}</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="icon">
										<i class="fa fa-shield fa-3x"></i>
										<p>Jaminan 100% Aman</p>
										<!-- <h2>24 DEC 2014</h2> -->
									</div>
								</a>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="icon">
										<i class="fa fa-credit-card fa-3x"></i>
										<p>Kemudahan Pembayaran</p>
										<!-- <h2>24 DEC 2014</h2> -->
									</div>
								</a>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="icon">
										<i class="fa fa-thumbs-o-up fa-3x"></i>
										<p>Layanan Pelanggan yang Responsif</p>
										<!-- <h2>24 DEC 2014</h2> -->
									</div>
								</a>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="icon">
										<i class="fa fa-truck fa-3x"></i>
										<p>Berbagai Jasa Pengiriman</p>
										<!-- <h2>24 DEC 2014</h2> -->
									</div>
								</a>
							</div>
						</div>
						
						
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="/images/home/map.png" alt="" />
							<p>{{ $global_params['alamat_toko'] or 'alamat_toko'}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- <div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div> -->
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2015 {{ $global_params['nama_perusahaan'] or 'nama_perusahaan'}}. All rights reserved.</p>
					<!-- <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p> -->
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min') }}.js"></script>
	<script src="{{ asset('js/jquery.scrollUp') }}.min.js"></script>
	<script src="{{ asset('js/price-range') }}.js"></script>
    <script src="{{ asset('js/jquery.prettyPhoto') }}.js"></script>
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
	<!-- autonumeric -->
	<script src="{{ asset('plugins/autoNumeric/autoNumeric-min.js') }}"></script>
	<!-- Select2 -->
	<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>

	<script type="text/javascript">
		$.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    });

	    $.fn.modal.Constructor.DEFAULTS.backdrop = 'static';

	    $.fn.liveposCurrency = {aSep: '.', aDec: ',', aSign: 'Rp. ', lZero: 'deny'};
	    $.fn.liveposNumeric = {aSep: '.', aDec: ',', aSign: '', lZero: 'deny', mDec: 0};

	    $('select').select2({width: '100%', theme: 'bootstrap'});              
	    
	    $('.input-mask-currency').autoNumeric('init', $.fn.liveposCurrency);
	    $('.input-mask-numeric').autoNumeric('init', $.fn.liveposNumeric);
	</script>
    <!-- Include this after the sweet alert js file -->
    @include('sweet::alert')

	@yield('script.footer')

</body>
</html>