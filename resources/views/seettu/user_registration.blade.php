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
                    <form action="{{ route('seettu.register') }}" method="POST" id="reg-form">
                        @csrf
                        <div class="form-group text-left mb-4"><span>Full Name</span>
                            <label for="username"><i class="lni lni-user"></i></label>
                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"
                                value="{{ old('name') }}" name="name" type="text" placeholder="{{  translate('Full Name') }}">
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group text-left mb-4"><span>Email</span>
                            <label for="email"><i class="lni lni-envelope"></i></label>
                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"
                                type="email" placeholder="{{  translate('Email') }}" name="email">
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group text-left mb-4"><span>Password</span>
                            <label for="password"><i class="lni lni-lock"></i></label>
                            <input class="input-psswd form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                id="registerPassword" type="password" name="password"
                                placeholder="********************">
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        @if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                        </div>
                        @endif

                        <div class="form-group text-left mb-4"><span>Confirm Password</span>
                            <label for="password"><i class="lni lni-lock"></i></label>
                            <input class="input-psswd form-control" id="registerPassword" type="password"
                                name="password_confirmation" placeholder="********************">
                        </div>
                        <button class="btn btn-success btn-lg w-100" type="submit">Sign Up</button>
                    </form>
                </div>
                <!-- Login Meta-->
                <div class="login-meta-data">
                    <p class="mt-3 mb-0">Already have an account?<a class="ml-1" href="{{ route('seettu.user.login') }}">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@section('script')
@if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif

<script type="text/javascript">
@if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
// making the CAPTCHA  a required field for form submission
$(document).ready(function() {
    // alert('helloman');
    $("#reg-form").on("submit", function(evt) {
        var response = grecaptcha.getResponse();
        if (response.length == 0) {
            //reCaptcha not verified
            alert("please verify you are humann!");
            evt.preventDefault();
            return false;
        }
        //captcha verified
        //do the rest of your validations here
        $("#reg-form").submit();
    });
});
@endif
</script>

@endsection