@extends('seettu.layouts.app')

@php
$total = 0;
@endphp

@section('content')

<div class="container">

    <!-- Cart Wrapper-->
    <div class="cart-wrapper-area py-3">
        <div class="cart-table card mb-3">
            <div class="table-responsive card-body">
                <table class="table mb-0">
                    <tbody id="cart-summary">
                        @if( Session::has('cart') && count(Session::get('cart')) > 0 )

                        @foreach (Session::get('cart') as $key => $cartItem)
                        @php
                        $product = \App\Product::find($cartItem['id']);
                        $total = $total + $cartItem['price']*$cartItem['quantity'];
                        $product_name_with_choice = $product->getTranslation('name');
                        if ($cartItem['variant'] != null) {
                        $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variant'];
                        }
                        @endphp
                        <tr>
                            <td><img src="{{ uploaded_asset($product->thumbnail_img) }}" alt=""></td>
                            <td><a href="{{ route('seettu.product', $product->slug) }}">{{ $product_name_with_choice }}<span>{{ single_price($cartItem['price']) }}
                                        x {{ $cartItem['quantity'] }}</span></a></td>
                            <td>
                                <div class="quantity">
                                    <input class="qty-text" type="text" value="{{ $cartItem['quantity'] }}" min="1"
                                        max="10" step="1" onchange="updateQuantity(0, this)" disabled>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                        @else
                        <tr>
                            <td colspan="3">
                                <span class="text-info">Cart is Empty</span>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Coupon Area-->
        @if( Session::has('cart') && count(Session::get('cart')) > 0 )
        <!-- Cart Amount Area-->
        <div class="card cart-amount-area">
            <div class="card-body d-flex align-items-center justify-content-between">

                <h5 class="total-price mb-0">Rs. <span class="counter" id="cart-total">{{ $total }}</span></h5>

            </div>
        </div>
        @endif
    </div>

    <!-- Cart Wrapper-->
    <div class="cart-wrapper-area py-3">

        <!-- User Meta Data-->
        <div class="card user-data-card">
            <div class="card-body">
                @if(Auth::check())
                <form class="form-default" data-toggle="validator"
                    action="{{ route('seettu.checkout.store_shipping_infostore') }}" role="form" method="POST">

                    @csrf



                    @php
                    $user = Auth::user();
                    $address = Auth::user()->addresses->last();
                    @endphp

                    <div class="mb-3">
                        <div class="title mb-2"><i class="lni lni-user"></i><span>Name</span></div>
                        <input class="form-control" name="name" type="text" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <div class="title mb-2"><i class="lni lni-envelope"></i><span>Email Address</span></div>
                        <input class="form-control" name="email" type="email" value="{{ $user->email }}" required>
                    </div>

                    <div class="mb-3">
                        <div class="title mb-2"><i class="lni lni-map-marker"></i><span>Shipping Address</span>
                        </div>
                        <input class="form-control" name="address" type="text" value="" required>
                    </div>

                    <div class="mb-3">
                        <div class="title mb-2"><i class="lni lni-user"></i><span>City</span></div>
                        <input class="form-control" name="city" type="text" value="" required>
                    </div>

                    <div class="mb-3">
                        <div class="title mb-2"><i class="lni lni-user"></i><span>Postal Code</span></div>
                        <input class="form-control" name="postal_code" type="number" value="" required>
                    </div>

                    <div class="mb-3">
                        <div class="title mb-2"><i class="lni lni-phone"></i><span>Phone</span></div>
                        <input class="form-control" name="phone" type="tel" value="" required>
                    </div>
                    <input type="hidden" name="checkout_type" value="logged">


                    <button class="btn btn-success w-100" type="submit">Delivery Info</button>




                </form>


                @else


                <form class="form-default" data-toggle="validator" action="{{ route('seettu.checkout.login') }}"
                    role="form" method="POST">
                    @csrf

                    <div class="mb-3">
                        <div class="title mb-2"><i class="lni lni-user"></i><span>Email</span></div>
                        <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                            type="text" required>
                    </div>
                    <div class="mb-3">
                        <div class="title mb-2"><i class="lni lni-envelope"></i><span>Password</span></div>
                        <input class="form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            type="password" required>
                    </div>

                    <div class="form-check mb-4 text-left">
                        <input class="form-check-input" type="checkbox" value="" id="remember" name="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>

                    <button class="btn btn-success btn-lg w-100" type="submit">Log In</button>


                </form>




                @endif




            </div>
        </div>
    </div>
</div>
@endsection
