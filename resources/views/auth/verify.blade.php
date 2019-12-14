@extends('lac::layouts.guest')

@section('title', __('Verify Your Email Address'))
@section('child-content')
    <form method="POST" action="{{ route('verification.resend') }}" id="auth-verify-form" data-ajax-form>
        @csrf
        <div class="card-body">
            {{ __('Before proceeding, please check your email for a verification link.') }}
        </div>
        <div class="card-footer text-right bg-light">
            <button type="submit" class="btn btn-primary">{{ __('Resend Verification Link') }}</button>
        </div>
    </form>
@endsection
