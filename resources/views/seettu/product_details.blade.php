@extends('seettu.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
<meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
<meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
<meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
<meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
<meta name="twitter:label1" content="Price">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
<meta property="og:type" content="og:product" />
<meta property="og:url" content="{{ route('seettu.product', $detailedProduct->slug) }}" />
<meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
<meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
<meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
<meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
<meta property="product:price:currency"
    content="{{ \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code }}" />
<meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection

@section('content')

<!-- Product Slides-->
<div class="product-slides owl-carousel">
    @php
    $photos = explode(',',$detailedProduct->photos);
    @endphp
    <!-- Single Hero Slide-->
    <div class="single-product-slide" style="background-image: url('{{ uploaded_asset($photos[0]) }}')"></div>
    @foreach ($photos as $key => $photo)
    <div class="single-product-slide" style="background-image: url('{{ uploaded_asset($photo) }}')"></div>
    @endforeach
</div>
<div class="product-description pb-3">
    <!-- Product Title & Meta Data-->
    <div class="product-title-meta-data bg-white mb-3 py-3">
        <div class="container d-flex justify-content-between">
            <div class="p-title-price">
                <h6 class="mb-0">{{  __($detailedProduct->name) }}</h6>
                @php
                    $qty = 0;
                    if($detailedProduct->variant_product){
                        foreach ($detailedProduct->stocks as $key => $stock) {
                            $qty += $stock->qty;
                        }
                    }
                    else{
                        $qty = $detailedProduct->current_stock;
                    }
                @endphp
                @if ($qty > 0)
                    <span class="badge badge-md badge-inline badge-pill badge-success">{{ translate('In stock')}}</span>
                    <div class="avialable-amount opacity-60">(<span id="available-quantity">{{ $qty }}</span> {{ translate('available')}})</div>
                @else
                    <span class="badge badge-md badge-inline badge-pill badge-danger">{{ translate('Out of stock')}}</span>
                @endif
                <p class="sale-price mb-0">{{ home_discounted_price($detailedProduct->id) }}
                </p>
            </div>
            <div href="javascript:void(0)" onclick="addToWishList({{ $detailedProduct->id }})" class="p-wishlist-share">
                <a href="#"><i class="lni lni-heart"></i></a></div>
        </div>
        <!-- Ratings-->
        <div class="product-ratings">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="ratings"> {{ renderStarRating($detailedProduct->rating) }}</div>
            </div>
        </div>
    </div>

    @if(false)
    <!-- Flash Sale Panel-->
    <div class="flash-sale-panel bg-white mb-3 py-3">
        <div class="container">
            <!-- Sales Offer Content-->
            <div class="sales-offer-content d-flex align-items-end justify-content-between">
                <!-- Sales End-->
                <div class="sales-end">
                    <p class="mb-1 font-weight-bold"><i class="lni lni-bolt"></i> Flash sale end in</p>
                    <!-- Please use event time this format: YYYY/MM/DD hh:mm:ss-->
                    <ul class="sales-end-timer pl-0 d-flex align-items-center" data-countdown="2022/01/01 14:21:37">
                        <li><span class="days">0</span>d</li>
                        <li><span class="hours">0</span>h</li>
                        <li><span class="minutes">0</span>m</li>
                        <li><span class="seconds">0</span>s</li>
                    </ul>
                </div>
                <!-- Sales Volume-->
                <div class="sales-volume text-right">
                    <p class="mb-1 font-weight-bold">82% Sold Out</p>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 82%;" aria-valuenow="82"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif



    <form id="option-choice-form">
        @csrf
        <input type="hidden" name="id" value="{{ $detailedProduct->id }}">

        <!-- Selection Panel-->
        <div class="selection-panel bg-white mb-3 py-3">
            <div class="container d-flex align-items-center justify-content-between">
                <!-- Choose Color-->
                @if (count(json_decode($detailedProduct->colors)) > 0)
                <div class="choose-color-wrapper">
                    <p class="mb-1 font-weight-bold">Color</p>
                    <div class="choose-color-radio d-flex align-items-center">
                        @foreach (json_decode($detailedProduct->colors) as $key => $color)
                        <!-- Single Radio Input-->
                        <div class="form-check mb-0">
                            <input class="form-check-input" style="background: {{ $color }};"
                                id="{{ $detailedProduct->id }}-color-{{ $key }}" value="{{ $color }}" type="radio"
                                name="color" @if($key==0) checked @endif>
                            <label class="form-check-label" for="{{ $detailedProduct->id }}-color-{{ $key }}"></label>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if ($detailedProduct->choice_options != null)
                @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                <!-- Choose Size-->
                <div class="choose-size-wrapper text-right">
                    <p class="mb-1 font-weight-bold">{{ \App\Attribute::find($choice->attribute_id)->name }}:</p>
                    <div class="choose-size-radio d-flex align-items-center">
                        @foreach ($choice->values as $key => $value)
                        <!-- Single Radio Input-->
                        <div class="form-check mb-0 mr-2">
                            <input class="form-check-input" id="{{ $choice->attribute_id }}-{{ $value }}" type="radio"
                                name="attribute_id_{{ $choice->attribute_id }}" value="{{ $value }}" @if($key==0)
                                checked @endif>
                            <label class="form-check-label"
                                for="{{ $choice->attribute_id }}-{{ $value }}">{{ $value }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
                @endif

            </div>
        </div>

        <!-- Product Specification-->
        <div class="p-specification bg-white mb-3 py-3">
            <div class="container">
                <div class="row no-gutters" id="chosen_price_div">
                    <div class="col-1">
                        <strong class="h6 fw-400 text-primary">{{ translate('Total')}}</strong>
                    </div>
                    <div class="col-11">
                        <div class="product-price">
                            <strong id="chosen_price" class="h6 fw-400 text-primary">

                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add To Cart-->
        <div class="cart-form-wrapper bg-white mb-3 py-3">
            <div class="container">
                <div class="cart-form">
                    <div class="order-plus-minus d-flex align-items-center">
                        <div class="quantity-button-handler">-</div>
                        <input class="form-control cart-quantity-input" name="quantity" type="text" step="1" min="1" max="10" value="1">
                        <div class="quantity-button-handler">+</div>
                    </div>
                    <button class="btn btn-danger ml-3 add-to-cart" onclick="addToCart()">Add To Cart</button>
                </div>
            </div>
        </div>

    </form>




    <!-- Product Specification-->
    <div class="p-specification bg-white mb-3 py-3">
        <div class="container">
            <h6>{{ translate('Description')}}</h6>
            <p><?php echo $detailedProduct->description; ?></p>
        </div>
    </div>

    @if(false)
    <!-- Rating & Review Wrapper-->
    <div class="rating-and-review-wrapper bg-white py-3 mb-3">
        <div class="container">
            <h6>Ratings &amp; Reviews</h6>
            <div class="rating-review-content">
                <ul class="pl-0">
                    <li class="single-user-review d-flex">
                        <div class="user-thumbnail"><img src="img/bg-img/7.jpg" alt=""></div>
                        <div class="rating-comment">
                            <div class="rating"><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i
                                    class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i
                                    class="lni lni-star-filled"></i></div>
                            <p class="comment mb-0">Very good product. It's just amazing!</p><span
                                class="name-date">Designing World 12 Dec 2020</span>
                        </div>
                    </li>
                    <li class="single-user-review d-flex">
                        <div class="user-thumbnail"><img src="img/bg-img/8.jpg" alt=""></div>
                        <div class="rating-comment">
                            <div class="rating"><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i
                                    class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i
                                    class="lni lni-star-filled"></i></div>
                            <p class="comment mb-0">WOW excellent product. Love it.</p><span class="name-date">Designing
                                World 8 Dec 2020</span>
                        </div>
                    </li>
                    <li class="single-user-review d-flex">
                        <div class="user-thumbnail"><img src="img/bg-img/9.jpg" alt=""></div>
                        <div class="rating-comment">
                            <div class="rating"><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i
                                    class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i
                                    class="lni lni-star-filled"></i></div>
                            <p class="comment mb-0">What a nice product it is. I am looking it's.</p><span
                                class="name-date">Designing World 28 Nov 2020</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Ratings Submit Form-->
    <div class="ratings-submit-form bg-white py-3">
        <div class="container">
            <h6>Submit A Review</h6>
            <form action="#" method="">
                <div class="stars mb-3">
                    <input class="star-1" type="radio" name="star" id="star1">
                    <label class="star-1" for="star1"></label>
                    <input class="star-2" type="radio" name="star" id="star2">
                    <label class="star-2" for="star2"></label>
                    <input class="star-3" type="radio" name="star" id="star3">
                    <label class="star-3" for="star3"></label>
                    <input class="star-4" type="radio" name="star" id="star4">
                    <label class="star-4" for="star4"></label>
                    <input class="star-5" type="radio" name="star" id="star5">
                    <label class="star-5" for="star5"></label><span></span>
                </div>
                <textarea class="form-control mb-3" id="comments" name="comment" cols="30" rows="10"
                    data-max-length="200" placeholder="Write your review..."></textarea>
                <button class="btn btn-sm btn-primary" type="submit">Save Review</button>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection


@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            getVariantPrice();
    	});
    </script>
@endsection
