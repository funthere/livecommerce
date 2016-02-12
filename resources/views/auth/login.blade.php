@extends('frontend')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li class="active">Login / Registrasi</li>
                </ol>
            </div>
        </div>
        <div class="container">
            @include('partials.login')
            <div class="row">
                <div class="col-sm-12">
                </div>
            </div>
        </div>
    </section>
@endsection