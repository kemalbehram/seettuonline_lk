<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <title>@yield('meta_title', get_setting('website_name').' | '.get_setting('site_motto'))</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords') )">

    @yield('meta')

    @if(!isset($detailedProduct) && !isset($shop) && !isset($page))
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">
    <meta itemprop="description" content="{{ get_setting('meta_description') }}">
    <meta itemprop="image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="twitter:description" content="{{ get_setting('meta_description') }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('seettu.home') }}" />
    <meta property="og:image" content="{{ uploaded_asset(get_setting('meta_image')) }}" />
    <meta property="og:description" content="{{ get_setting('meta_description') }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
    @endif

    <!-- Favicon -->
    <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">

    <!-- Stylesheet-->
    
    <style>
        body{
            font-family: 'Open Sans', sans-serif;
            font-weight: 400;
        }
        :root{
            --primary: {{ get_setting('base_color', '#e62d04') }};
            --hov-primary: {{ get_setting('base_hov_color', '#c52907') }};
            --soft-primary: {{ hex2rgba(get_setting('base_color','#e62d04'),.15) }};
        }
    </style>
    <link rel="stylesheet" href="{{ static_asset('seettu_assets/style.css') }}">

    <script>
    var AIZ = AIZ || {};
    </script>
    @if (\App\BusinessSetting::where('type', 'google_analytics')->first()->value == 1)
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('TRACKING_ID') }}"></script>

    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', '{{ env('
        TRACKING_ID ') }}');
    </script>
    @endif

    @if (\App\BusinessSetting::where('type', 'facebook_pixel')->first()->value == 1)
    <!-- Facebook Pixel Code -->
    <script>
    ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '{{ env('
        FACEBOOK_PIXEL_ID ') }}');
    fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id={{ env('FACEBOOK_PIXEL_ID') }}/&ev=PageView&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->
    @endif
    <!-- Web App Manifest-->
</head>

<body>
    <!-- Preloader-->
    <div class="preloader" id="preloader">
        <div class="spinner-grow text-secondary" role="status">
            <div class="sr-only">Loading...</div>
        </div>
    </div>
    <!-- Header Area-->
    @hasSection('navigation')
    @yield('navigation')
    @else
    <div class="header-area" id="headerArea">
        <div class="container h-100 d-flex align-items-center justify-content-between">
            <!-- Logo Wrapper-->
            <div class="logo-wrapper"><a href="{{ route('seettu.home') }}"><img
                        src="{{ my_asset('seettu_assets/img/seettu-logo.png') }}" alt="{{ env('APP_NAME') }}"></a></div>
            <!-- Search Form-->
            <div class="top-search-form">
                <form action="{{ route('seettu.search') }}" method="GET">
                    <input class="form-control" type="search" id="search" name="q"
                        placeholder="{{translate('I am shopping for...')}}" autocomplete="off">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <!-- Navbar Toggler-->
            <div class="suha-navbar-toggler d-flex flex-wrap" id="suhaNavbarToggler">
                <span></span><span></span><span></span>
            </div>
        </div>
    </div>
    <!-- Sidenav Black Overlay-->
    <div class="sidenav-black-overlay"></div>
    <!-- Side Nav Wrapper-->
    <div class="suha-sidenav-wrapper" id="sidenavWrapper">
        <!-- Sidenav Profile-->
        <div class="sidenav-profile">
            @auth

            @if (Auth::user()->avatar_original != null)
            <div class="user-profile"><img src="{{ uploaded_asset(Auth::user()->avatar_original) }}" alt=""></div>
            @else
            <div class="user-profile"><img src="{{ static_asset('assets/img/avatar-place.png') }}" alt=""></div>
            @endif

            <div class="user-info">
                <h6 class="user-name mb-0">{{ Auth::user()->name }}</h6>
            </div>
            @else
            @php
            $logo = get_setting('header_logo');
            @endphp
            <div class="user-profile"><img src="{{ uploaded_asset($logo) }}" alt=""></div>

            @endif
        </div>

        <!-- Sidenav Nav-->
        <ul class="sidenav-nav pl-0">
            <li><a href="{{ route('seettu.cart') }}"><i class="lni lni-cart"></i>Cart
                    @if(Session::has('cart'))
                    <span class="ml-3 badge badge-warning">{{ count(Session::get('cart'))}}</span>
                    @endif
                </a></li>
            <li><a href="{{ route('seettu.wishlists.index') }}"><i
                        class="lni lni-heart lni-tada-effect"></i>{{translate('Wishlist')}}
                    @if(Auth::check())
                    <span class="ml-3 badge badge-warning">{{ count(Auth::user()->wishlists)}}</span>
                    @else
                    <span class="ml-3 badge badge-warning">0</span>
                    @endif
                </a></li>

            <!-- <li><a href="pages.html"><i class="lni lni-empty-file"></i>All Pages</a></li>
          <ul>
            <li><a href="wishlist-grid.html">- Wishlist Grid</a></li>
            <li><a href="wishlist-list.html">- Wishlist List</a></li>
          </ul>
        </li> -->
            @auth
            <li><a href="#"><i class="lni lni-cog"></i>Settings</a></li>
            <li><a href="{{ route('seettu.logout') }}"><i class="lni lni-power-switch"></i>Log Out</a></li>
            @else
            <li><a href="{{ route('seettu.user.login') }}"><i class="lni lni-user"></i>Login</a></li>
            <li><a href="{{ route('seettu.user.registration') }}"><i class="lni lni-users"></i>Register</a></li>
            @endif
        </ul>

        <!-- Go Back Button-->
        <div class="go-home-btn" id="goHomeBtn"><i class="lni lni-arrow-left"></i></div>
    </div>
    @endif
    <div class="page-content-wrapper">