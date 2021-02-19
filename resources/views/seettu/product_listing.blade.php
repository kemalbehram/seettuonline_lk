@extends('seettu.layouts.app')

@include('seettu.inc.search_filter')


@if (isset($category_id))
@php
$meta_title = \App\Category::find($category_id)->meta_title;
$meta_description = \App\Category::find($category_id)->meta_description;
@endphp
@elseif (isset($brand_id))
@php
$meta_title = \App\Brand::find($brand_id)->meta_title;
$meta_description = \App\Brand::find($brand_id)->meta_description;
@endphp
@else
@php
$meta_title = get_setting('meta_title');
$meta_description = get_setting('meta_description');
@endphp
@endif

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $meta_title }}">
<meta itemprop="description" content="{{ $meta_description }}">

<!-- Twitter Card data -->
<meta name="twitter:title" content="{{ $meta_title }}">
<meta name="twitter:description" content="{{ $meta_description }}">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}" />
@endsection


@section('content')


<!-- Catagory Single Image-->
@if (isset($category_id) && \App\Category::find($category_id)->banner != null)
<div class="catagory-single-img"
    style="background-image: url('{{ uploaded_asset(\App\Category::find($category_id)->banner) }}')"></div>
@endif

<!-- Top Products-->
<div class="top-products-area py-3">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">
                @if(isset($category_id))
                {{  translate(\App\Category::find($category_id)->getTranslation('name')) }}
                @else
                Search Result for "{{ Request::get('q') }}"
                @endif

            </h6>
        </div>
        <div class="row g-3">
            @if(count($products) > 0)
                <!-- Single Top Product Card-->
            @foreach ($products as $key => $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card top-product-card">
                    <div class="card-body"><span class="badge badge-success">Sale</span><a class="wishlist-btn"
                            href="javascript:void(0)" onclick="addToWishList({{ $product->id }})"><i
                                class="lni lni-heart"></i></a><a class="product-thumbnail d-block"
                            href="javascript:void(0)"><img class="mb-2"
                                src="{{ uploaded_asset($product->thumbnail_img) }}" alt=""></a><a
                            class="product-title d-block"
                            href="{{ route('seettu.product', $product->slug) }}">{{  $product->getTranslation('name')  }}</a>
                        <p class="sale-price">
                            {{ home_discounted_base_price($product->id) }}

                            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                            <span>
                                {{ home_base_price($product->id) }}
                            </span>
                            @endif

                        </p>
                        <div class="product-rating">
                            {{ renderStarRating($product->rating) }}
                        </div>
                        <a class="btn btn-success btn-sm" href="{{ route('seettu.product', $product->slug) }}"><i class="lni lni-plus"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $products->links() }}
            @else
            <h5 class="text-dart pr-3 mb-0">No Products Found</h5>
            @endif

        </div>
    </div>
</div>

@endsection