@extends('frontend')

@section('content')

	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							@foreach($banners as $banner)
							<div class="item <?php if (!isset($numberBanner)) {echo 'active'; $numberBanner = 0; } ?>">
								<div class="col-sm-6">
									<h1>{{ $banner->produk }}</h1>
									<h2>{{ 'Rp '.number_format($banner->harga, 0, ',', '.') }}</h2>
									<p>{{ $banner->deskripsi }}</p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{ asset('/asset/produk/'.$banner->foto) }}" class="girl img-responsive" alt="" />
									<!-- <img src="images/home/pricing.png"  class="pricing" alt="" /> -->
								</div>
							</div>
							
							@endforeach	
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<div class="kategoris_products"><!--brands_products-->
							<h2>Kategori</h2>
							<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@if(isset($kategoris))
							@foreach($kategoris as $kategori)
								@if(count($kategori->produks))
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											@if($kategori->subKategoris)
											<a data-toggle="collapse" data-parent="#accordian" href="#{{ str_slug($kategori->kategori) }}">
												<span class="badge pull-right"><i class="fa fa-plus"></i></span>
												{{ ucwords($kategori->kategori) }}
											</a>
											@else
											<h4 class="panel-title"><a href="{{ $kategori->kategori }}">{{ $kategori->kategori }}</a></h4>
											@endif
										</h4>
									</div>
									@if($kategori->subKategoris)
									<div id="{{ str_slug($kategori->kategori) }}" class="panel-collapse collapse">
										<div class="panel-body">
											<ul>
											@foreach($kategori->subKategoris as $subKategori)
												<li><a href="{{ $subKategori->kategori }}">{{ $subKategori->kategori }}</a></li>
											@endforeach
											</ul>
										</div>
									</div>
									@endif
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
									</div>
								</div>
								@endif
							@endforeach
							@endif
							</div><!--/category-products-->
						</div><!--/kategori_products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Merk</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
								@if(isset($brands))
								@foreach($brands as $brand)
									@if(count($brand->produks))
									<li><a href="{{ $brand->brand }}"> {{ $brand->brand }} <span class="pull-right">({{ count($brand->produks) }})</span></a></li>
									@endif
								@endforeach
								@endif
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Range Harga</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">Rp 0</b> <b class="pull-right">Rp 600</b>
							</div>
						</div><!--/price-range-->
						
						<!--shipping-->
						<!-- <div class="shipping text-center">
							<img src="images/home/shipping.jpg" alt="" />
						</div> -->
						<!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Featured Items</h2>
						@if(isset($produks))
						@foreach($produks as $produk)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products {{ ($produk->isSale) ? 'sale' : '' }}">
									<div class="productinfo text-center">
										<div class="img" style="background-image: url({{ asset('/asset/produk/'.$produk->foto) }});" title="{{ $produk->produk }}"></div>
										@if($produk->isSale)
										<h2>Rp. {{ $produk->harga_diskon_rupiah }}</h2>
										<h4><del>Rp. {{ $produk->harga_rupiah }}</del></h4>
										@else
										<h2>Rp. {{ $produk->harga_rupiah }}</h2>
										@endif
										<p class="product-name">{{ $produk->produk }}</p>
										<a href="{{ url('beli/'.$produk->slug) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											@if($produk->isSale)
											<h2>Rp. {{ $produk->harga_diskon_rupiah }}</h2>
											<h4><del>Rp. {{ $produk->harga_rupiah }}</del></h4>
											@else
											<h2>Rp. {{ $produk->harga_rupiah }}</h2>
											@endif
											<p class="product-name">{{ $produk->produk }}</p>
											<a href="{{ url('beli/'.$produk->slug) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
									@if($produk->isSale)
									<img src="images/home/sale.png" class="sale" alt="Sale" />
									@endif
									@if($produk->isNew)
									<img src="images/home/new.png" class="new" alt="New Item" />
									@endif
								</div>
						<!-- 		<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
						 -->	</div>
						</div>
						@endforeach
						@endif
					</div><!--features_items-->
					
				@if(isset($kategoris))	
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
							<?php $firstK = 0; ?>
							@foreach($kategoris as $kategori)
							@if(count($kategori->produks))
								<li class="{{ 0 == $firstK++ ? 'active' : '' }}"><a href="#kategori-{{ str_slug($kategori->kategori) }}" data-toggle="tab">{{ $kategori->kategori }}</a></li>
							@endif
							@endforeach
							</ul>
						</div>
						<div class="tab-content">
							<?php $firstK = 0; ?>
							@foreach($kategoris as $kategori)
							@if(count($kategori->produks))
							<div class="tab-pane fade {{ 0 == $firstK++ ? 'active in' : '' }}" id="kategori-{{ str_slug($kategori->kategori) }}" >
								@foreach($kategori->produks as $produk)
								<div class="col-sm-3">
									<div class="single-products {{ ($produk->isSale) ? 'sale' : '' }}">
										<div class="productinfo text-center">
											<div class="img" style="background-image: url({{ asset('/asset/produk/'.$produk->foto) }});" title="{{ $produk->produk }}"></div>
											@if($produk->isSale)
											<h2>Rp. {{ $produk->harga_diskon_rupiah }}</h2>
											<h4><del>Rp. {{ $produk->harga_rupiah }}</del></h4>
											@else
											<h2>Rp. {{ $produk->harga_rupiah }}</h2>
											@endif
											<p class="product-name">{{ $produk->produk }}</p>
											<a href="{{ url('beli/'.$produk->slug) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							@endif
							@endforeach
						</div>
					</div><!--/category-tab-->
				@endif
				<!--	
					<div class="recommended_items">
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div>
				-->
				</div>
			</div>
		</div>
	</section>

@stop