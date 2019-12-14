@extends('lac::layouts.guest')

@section('title', __('Confirm Password'))
@section('child-content')
    <form method="POST" action="{{ route('password.confirm') }}" data-ajax-form>
        @csrf
        <div class="card-body">
            <p>{{ __('Please confirm your password before continuing.') }}</p>
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
        <div class="card-footer text-right bg-light">
            <button type="submit" class="btn btn-primary">{{ __('Confirm Password') }}</button>
        </div>
    </form>
@endsection
