@extends('seettu.layouts.app')

@section('content')

<!-- Login Wrapper Area-->
<div class="login-wrapper d-flex align-items-center justify-content-center text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5"><img class="big-logo"
                    src="{{ uploaded_asset(get_setting('system_logo_white')) }}" alt="">
                <!-- Register Form-->
                <div class="register-form mt-5 px-4">
                    <form action="{{ route('seettu.password.email') }}" method="POST">
                        @csrf

                        <div class="form-group text-left mb-4"><span>Email</span>
                            <label for="email"><i class="lni lni-user"></i></label>
                            <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"
                                type="mail" value="{{ old('email') }}" placeholder="{{ translate('Email') }}"
                                name="email">
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <button class="btn btn-warning btn-lg w-100"
                            type="submit">{{ translate('Send Password Reset Link') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection