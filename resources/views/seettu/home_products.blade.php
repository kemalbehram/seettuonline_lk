@if(env('SHOW_HOME_PRODUCTS'))
<!-- Flash Sale Slide-->
@if($num_todays_deal > 0)
<div class="flash-sale-wrapper">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">{{ translate('Todays Deal') }} <span
                    class="badge badge-danger">{{ translate('Hot') }}</span></h6>
            <!-- <a class="btn btn-primary btn-sm" href="flash-sale.html">View All</a> -->
        </div>
        <!-- Flash Sale Slide-->
        <div class="flash-sale-slide owl-carousel">
            <!-- Single Flash Sale Card-->
            @foreach (filter_products(\App\Product::where('published', 1)->where('todays_deal', '1'))->get() as $key =>
            $product)
            @if ($product != null)
            <div class="card flash-sale-card">
                <div class="card-body"><a href="{{ route('seettu.product', $product->slug) }}"><img
                            src="{{ my_asset($product->thumbnail_img) }}" alt=""><span
                            class="product-title">{{ __($product->name) }}</span>
                        <p class="sale-price">{{ home_discounted_base_price($product->id) }}
                            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                            <span class="real-price">{{ home_base_price($product->id) }}</span>
                            @endif

                            <!-- </p><span class="progress-title">33% Sold Out</span> -->
                            <!-- Progress Bar-->
                            <!-- <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                  </div> -->
                    </a>
                </div>
            </div>
            @endif
            @endforeach

        </div>
    </div>
</div>
@endif

<!-- Top Products-->
<div class="top-products-area clearfix py-3">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">{{ translate('Featured Products')}}</h6>
            <!-- <a class="btn btn-danger btn-sm" href="shop-grid.html">View All</a> -->
        </div>
        <div class="row g-3">
            <!-- Single Top Product Card-->
            @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->limit(12)->get() as
            $key => $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card top-product-card">
                    <div class="card-body"><span class="badge badge-success">Sale</span><a class="wishlist-btn"
                            href="#"><i class="lni lni-heart"></i></a><a class="product-thumbnail d-block"
                            href="{{ route('seettu.product', $product->slug) }}"><img class="mb-2"
                                src="{{ my_asset($product->thumbnail_img) }}" alt=""></a><a
                            class="product-title d-block"
                            href="{{ route('seettu.product', $product->slug) }}">{{ __($product->name) }}</a>
                        <p class="sale-price">{{ home_discounted_base_price($product->id) }}
                            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                            <span>{{ home_base_price($product->id) }}</span>
                            @endif
                        </p>
                        <div class="product-rating">{{ renderStarRating($product->rating) }}</div><a
                            class="btn btn-success btn-sm add2cart-notify"
                            href="{{ route('seettu.product', $product->slug) }}"><i class="lni lni-plus"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


<!-- Cool Facts Area-->
<!-- <div class="cta-area">
        <div class="container">
          <div class="cta-text p-4 p-lg-5" style="background-image: url(img/bg-img/24.jpg)">
            <h4>Winter Sale 50% Off</h4>
            <p>Suha is a multipurpose, creative &amp; <br>modern mobile template.</p><a class="btn btn-danger" href="#">Shop Today</a>
          </div>
        </div>
      </div> -->

@foreach (\App\HomeCategory::where('status', 1)->get() as $key => $homeCategory)
@if ($homeCategory->category != null)
<!-- Top Products-->
<div class="top-products-area clearfix py-3">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">{{ translate($homeCategory->category->name) }}</h6>
            <a class="btn btn-danger btn-sm" href="{{ route('seettu.products.category', $homeCategory->category->slug) }}">View
                More</a>
        </div>
        <div class="row g-3">
            <!-- Single Top Product Card-->
            @foreach (filter_products(\App\Product::where('published', 1)->where('category_id',
            $homeCategory->category->id))->latest()->limit(12)->get() as $key => $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card top-product-card">
                    <div class="card-body">
                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                        <span class="badge badge-success">Sale</span>
                        @endif
                        <a class="wishlist-btn" href="#"><i class="lni lni-heart"></i></a><a
                            class="product-thumbnail d-block" href="{{ route('seettu.product', $product->slug) }}"><img
                                class="mb-2" src="{{ my_asset($product->thumbnail_img) }}" alt=""></a><a
                            class="product-title d-block"
                            href="{{ route('seettu.product', $product->slug) }}">{{ __($product->name) }}</a>
                        <p class="sale-price">{{ home_discounted_base_price($product->id) }}
                            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                            <span>{{ home_base_price($product->id) }}</span>
                            @endif
                        </p>
                        <div class="product-rating">{{ renderStarRating($product->rating) }}</div><a
                            class="btn btn-success btn-sm add2cart-notify"
                            href="{{ route('seettu.product', $product->slug) }}"><i class="lni lni-plus"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endforeach

<!-- Discount Coupon Card-->
<!-- <div class="container">
        <div class="card discount-coupon-card border-0">
          <div class="card-body">
            <div class="coupon-text-wrap d-flex align-items-center p-3">
              <h5 class="text-white pr-3 mb-0">Get 20% <br> discount</h5>
              <p class="text-white pl-3 mb-0">To get discount, enter the<strong class="px-1">GET20</strong>code on the checkout page.</p>
            </div>
          </div>
        </div>
      </div> -->

@if (\App\BusinessSetting::where('type', 'best_selling')->first()->value == 1)
<!-- Weekly Best Sellers-->
<div class="weekly-best-seller-area py-3">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="pl-1">Weekly Best Sellers</h6><span class="label label-default">{{translate('Top 20')}}</span>
        </div>
        <div class="row g-3">
            <!-- Single Weekly Product Card-->
            @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale',
            'desc'))->limit(20)->get() as $key => $product)
            <div class="col-12 col-md-6">
                <div class="card weekly-product-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="product-thumbnail-side">
                            <span class="badge badge-success">Sale</span>
                            <!-- <a class="wishlist-btn" href="#"><i class="lni lni-heart"></i></a> -->
                            <a class="product-thumbnail d-block" href="{{ route('seettu.product', $product->slug) }}"><img
                                    src="{{ my_asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}"></a>
                        </div>
                        <div class="product-description"><a class="product-title d-block"
                                href="{{ route('seettu.product', $product->slug) }}">{{ __($product->name) }}</a>
                            <p class="sale-price">
                                <i class="lni lni-dollar">
                                </i>{{ home_discounted_base_price($product->id) }}
                                @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                <span>{{ home_base_price($product->id) }}</span>
                                @endif
                            </p>
                            <div class="product-rating">{{ renderStarRating($product->rating) }}</div><a
                                class="btn btn-success btn-sm add2cart-notify"
                                href="{{ route('seettu.product', $product->slug) }}"><i class="mr-1 lni lni-cart"></i>Buy
                                Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Featured Products Wrapper-->
@if(false)
<div class="featured-products-wrapper py-3">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="pl-1">Featured Products</h6><a class="btn btn-warning btn-sm" href="featured-products.html">View
                All</a>
        </div>
        <div class="row g-3">
            <!-- Featured Product Card-->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card featured-product-card">
                    <div class="card-body"><span class="badge badge-warning custom-badge"><i
                                class="lni lni-star"></i></span>
                        <div class="product-thumbnail-side"><a class="wishlist-btn" href="#"><i
                                    class="lni lni-heart"></i></a><a class="product-thumbnail d-block"
                                href="single-product.html"><img src="img/product/14.png" alt=""></a></div>
                        <div class="product-description"><a class="product-title d-block"
                                href="single-product.html">Blue Skateboard</a>
                            <p class="sale-price">$64<span>$89</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Featured Product Card-->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card featured-product-card">
                    <div class="card-body"><span class="badge badge-warning custom-badge"><i
                                class="lni lni-star"></i></span>
                        <div class="product-thumbnail-side"><a class="wishlist-btn" href="#"><i
                                    class="lni lni-heart"></i></a><a class="product-thumbnail d-block"
                                href="single-product.html"><img src="img/product/15.png" alt=""></a></div>
                        <div class="product-description"><a class="product-title d-block"
                                href="single-product.html">Travel Bag</a>
                            <p class="sale-price">$64<span>$89</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Featured Product Card-->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card featured-product-card">
                    <div class="card-body"><span class="badge badge-warning custom-badge"><i
                                class="lni lni-star"></i></span>
                        <div class="product-thumbnail-side"><a class="wishlist-btn" href="#"><i
                                    class="lni lni-heart"></i></a><a class="product-thumbnail d-block"
                                href="single-product.html"><img src="img/product/16.png" alt=""></a></div>
                        <div class="product-description"><a class="product-title d-block"
                                href="single-product.html">Cotton T-shirts</a>
                            <p class="sale-price">$64<span>$89</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Featured Product Card-->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card featured-product-card">
                    <div class="card-body"><span class="badge badge-warning custom-badge"><i
                                class="lni lni-star"></i></span>
                        <div class="product-thumbnail-side"><a class="wishlist-btn" href="#"><i
                                    class="lni lni-heart"></i></a><a class="product-thumbnail d-block"
                                href="single-product.html"><img src="img/product/6.png" alt=""></a></div>
                        <div class="product-description"><a class="product-title d-block"
                                href="single-product.html">Roof Lamp </a>
                            <p class="sale-price">$64<span>$89</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endif