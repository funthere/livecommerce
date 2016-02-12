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
					Step1
					<span class="pull-right">Registrasi</span>
				</h2>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<h4>Jika tidak ingin registrasi, silakan klik Lanjut</h4>
					<a class="btn btn-primary" href="{{ url('checkout/without_registration') }}">Lanjut (Tanpa Registrasi)</a>
					<hr>
				</div>
			</div>
			@include('partials.login')
			<div class="row">
				<div class="col-sm-12">
				</div>
			</div>
		</div>
	</section>
@endsection