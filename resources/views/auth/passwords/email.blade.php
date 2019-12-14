@extends('lac::layouts.guest')

@section('title', __('Reset Password'))
@section('child-content')
    <form method="POST" action="{{ route('password.email') }}" id="auth-passwords-email-form" data-ajax-form>
        @csrf
        <div class="card-body">
            <div class="form-group mb-0">
                <label for="email">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" class="form-control" data-error-input="email">
                <div class="invalid-feedback" data-error-feedback="email"></div>
            </div>
        </div>
        <div class="card-footer text-right bg-light">
            <button type="submit" class="btn btn-primary">{{ __('Send Password Reset Link') }}</button>
        </div>
    </form>
@endsection
