                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">{{ $judulProduk or 'Semua Item' }}</h2>
                        @if(isset($produks) && count($produks))
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
                                    <!-- <div class="product-overlay">
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
                                    </div> -->
                                    @if($produk->isSale)
                                    <img src="/images/home/sale.png" class="sale" alt="Sale" />
                                    @endif
                                    @if($produk->isNew)
                                    <img src="/images/home/new.png" class="new" alt="New Item" />
                                    @endif
                                </div>
                        <!--        <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                     -->    </div>
                        </div>
                        @endforeach
                        @else
                            <p class="text-center info">Tidak ada produk yang bisa ditampilkan.</p>
                        @endif
                    </div><!--features_items-->