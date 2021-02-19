@extends('seettu.layouts.app')

@section('content')
@if (get_setting('home_slider_images') != null)
<!-- Hero Slides-->
<div class="hero-slides owl-carousel">
    <!-- Single Hero Slide-->
    @php $slider_images = json_decode(get_setting('home_slider_images'), true); @endphp
    @foreach ($slider_images as $key => $value)
    <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
        <div class="single-hero-slide" style="background-image: url('{{ uploaded_asset($slider_images[$key]) }}')">
            <div class="slide-content h-100 d-flex align-items-center">
            </div>
        </div>
    </a>
    @endforeach
</div>
@endif

<!-- Product Catagories-->
@php
$featured_categories = \App\Category::where('featured', 1)->get();
@endphp
@if (count($featured_categories) > 0)

<div class="product-catagories-wrapper py-3">
    <div class="container">
        <div class="section-heading">
            <h6 class="ml-1">Product Category</h6>
        </div>
        <div class="product-catagory-wrap">
            <div class="row g-3">
                <!-- Single Catagory Card-->
                @foreach ($featured_categories as $key => $category)
                <div class="col-6">
                    <div class="card catagory-card">
                        <div class="card-body">
                            <a href="{{ route('seettu.products.category', $category->slug) }}">
                                <img class="lni pb-1" src="{{ uploaded_asset($category->icon) }}" width="50"
                                    alt="{{ $category->getTranslation('name') }}">
                                <span>{{ $category->getTranslation('name') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

@include('seettu.home_products')
<!-- Night Mode View Card-->

    <!-- PWA Install Alert-->
    <div class="toast pwa-install-alert shadow" id="pwaInstallToast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="8000" data-autohide="true">
      <div class="toast-body">
        <button class="ml-3 close" type="button" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="content d-flex align-items-center mb-2"><img src="{{ my_asset('seettu_assets/img/seettu-logo.png') }}" alt="">
          <h6 class="mb-0 text-white">Add to Home Screen</h6>
        </div><span class="mb-0 d-block text-white">Add Suha on your mobile home screen. Click the<strong class="mx-1">"Add to Home Screen"</strong>button & enjoy it like a regular app.</span>
      </div>
    </div>
    <div class="page-content-wrapper">
@endsection