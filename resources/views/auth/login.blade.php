@extends('lac::layouts.guest')

@section('title', __('Login'))
@section('child-content')
    <form method="POST" action="{{ route('login') }}" data-ajax-form>
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" class="form-control" data-error-input="email">
                <div class="invalid-feedback" data-error-feedback="email"></div>
            </div>
            <div class="form-group mb-0">
                <div class="row">
                    <div class="col">
                        <label for="password">{{ __('Password') }}</label>
                    </div>
                    <div class="col-auto">
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="small">{{ __('Forgot Password?') }}</a>
                        @endif
                    </div>
                </div>
                <input type="password" name="password" id="password" class="form-control" data-error-input="password">
                <div class="invalid-feedback" data-error-feedback="password"></div>
            </div>
        </div>
        <div class="card-footer bg-light">
            <div class="row align-items-center">
                <div class="col">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                        <label for="remember" class="custom-control-label">{{ __('Remember Me') }}</label>
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
