@extends('seettu.layouts.app')
@section('content')
<!-- Login Wrapper Area-->
<div class="login-wrapper d-flex align-items-center justify-content-center text-center">
    <!-- Background Shape-->
    <div class="background-shape"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5"><img class="big-logo"
                    src="{{ uploaded_asset(get_setting('system_logo_white')) }}" alt="">
                <!-- Register Form-->
                <div class="register-form mt-5 px-4">
                    <form action="{{ route('seettu.login') }}" method="POST">
                        @csrf
                        <h1 class="h4 fw-600 text-white mb-4">
                            {{ translate('Login to your account.')}}
                            
                        </h1>
                        <div class="form-group text-left mb-4"><span>Email</span>
                            <label for="email"><i class="lni lni-user"></i></label>
                            <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"
                                type="text" placeholder="info@example.com" value="{{ old('email') }}" name="email">
                        </div>
                        <div class="form-group text-left mb-4"><span>Password</span>
                            <label for="password"><i class="lni lni-lock"></i></label>
                            <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                id="password" type="password" placeholder="********************" name="password">
                        </div>

                        <div class="form-check mb-4 text-left">
                            <input class="form-check-input" type="checkbox" value="" id="remember" name="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-white" for="remember">
                                Remember Me
                            </label>
                        </div>

                        <button class="btn btn-success btn-lg w-100" type="submit">Log In</button>
                    </form>
                </div>
                <!-- Login Meta-->
                <div class="login-meta-data"><a class="forgot-password d-block mt-3 mb-1"
                        href="{{ route('seettu.password.request') }}">Forgot Password?</a>
                    <p class="mb-0">Didn't have an account?<a class="ml-1"
                            href="{{ route('seettu.user.registration') }}">Register Now</a></p>
                </div>
                 <!-- View As Guest-->
            <div class="view-as-guest mt-3"><a class="btn" href="{{ route('seettu.checkout.shipping_info') }}">Checkout as Guest</a></div>
            </div>
        </div>
    </div>
</div>

@endsection