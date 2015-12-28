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
					<a class="btn btn-primary">Lanjut (Tanpa Registrasi)</a>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login ke Akun Anda</h2>
						{!! Form::open(['url' => url('auth/login/next=checkut') ]) !!}
							<input type="email" name="email" placeholder="Email Address" />
							<input type="password" name="password" placeholder="Password" />
							<span>
								<input type="checkbox" name="remember" class="checkbox"> 
								Ingat Saya
								<a href="/auth/forgotpassword" class="pull-right">Lupa Password</a>
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						{!! Form::close() !!}
					</div><!--/login form-->
				</div>
				<div class="col-sm-2">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Daftar Baru</h2>
						{!! Form::open(['url' => 'auth/signup?next=checkout']) !!}
							<input type="email" name="emai" placeholder="Email Address"/>
							<input type="password" name="password" placeholder="Password"/>
							<input type="password" name="password_confirm" placeholder="Ulangi Password"/>
							<p>
								Dengan melakukan registrasi berarti Anda setuju  dengan peraturan kami
							</p>
							<button type="submit" class="btn btn-default">Daftar</button>
						{!! Form::close() !!}
					</div><!--/sign up form-->
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
				</div>
			</div>
		</div>
	</section>
@endsection