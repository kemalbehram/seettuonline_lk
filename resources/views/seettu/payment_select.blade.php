@extends('seettu.layouts.app')

@section('content')
<div class="page-content-wrapper">
        <div class="container">
            <!-- Checkout Wrapper-->
            <div class="checkout-wrapper-area py-3">
                
                <!-- Choose Payment Method-->
                <div class="choose-payment-method">
                    <h6 class="mb-3 text-center">Choose Payment Method</h6>
                    <div class="row justify-content-center g-3">
                        @if(false)
                        <!-- Single Payment Method-->
                        <div class="col-6 col-md-5">
                            <div class="single-payment-method"><a class="credit-card"
                                    href="checkout-credit-card.html"><i class="lni lni-credit-cards"></i>
                                    <h6>Credit Card</h6>
                                </a></div>
                        </div>
                        <!-- Single Payment Method-->
                        <div class="col-6 col-md-5">
                            <div class="single-payment-method"><a class="bank" href="checkout-bank.html"><i
                                        class="lni lni-restaurant"></i>
                                    <h6>Bank</h6>
                                </a></div>
                        </div>
                        @endif
                        <!-- Single Payment Method-->
                        <div class="col-6 col-md-5">
                            <div class="single-payment-method"><a class="cash" href="{{ route('seettu.payment.checkout.cod') }}"><i
                                        class="lni lni-revenue"></i>
                                    <h6>Cash on Delivery</h6>
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
