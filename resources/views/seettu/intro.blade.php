@extends('seettu.layouts.app')
@php
    $logo = get_setting('header_logo');
@endphp
@section('content')
<div class="intro-wrapper d-flex justify-content-center text-center">
    <!-- Background Shape-->
    <div class="background-shape"></div>
    <div class="container" style="margin-top: 10%;"><img class="big-logo" src="{{ uploaded_asset(get_setting('system_logo_white')) }}" alt=""></div>
</div>
<div class="get-started-btn"><a class="btn btn-success btn-lg w-100" href="{{ route('seettu.user.login') }}">Go</a></div>
@endsection