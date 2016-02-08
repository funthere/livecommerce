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
                                            <h4 class="panel-title @if(request()->is('shop/'.$kategori->slug)) active @endif"><a href="/shop/{{ $kategori->slug }}">{{ $kategori->kategori }}</a></h4>
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
                                    <li class="panel-title @if(request()->is('shop/merk/'.$brand->slug)) active @endif"><a href="/shop/merk/{{ $brand->slug }}"> {{ $brand->brand }} <span class="pull-right">({{ count($brand->produks) }})</span></a></li>
                                    @endif
                                @endforeach
                                @endif
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        
                        <div class="price-range"><!--price-range-->
                            <h2>Range Harga</h2>
                            <div class="well text-center">
                                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600000" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                 <b class="pull-left">Rp 0</b> <b class="pull-right">Rp 600.000</b>
                            </div>
                        </div><!--/price-range-->
                        
                        <!--shipping-->
                        <!-- <div class="shipping text-center">
                            <img src="images/home/shipping.jpg" alt="" />
                        </div> -->
                        <!--/shipping-->
                    
                    </div>