@extends('lac::layouts.auth')

@section('title', __('Home'))
@section('child-content')
    <h1 class="mb-4">@yield('title')</h1>
    <p>{{ __('You are logged in!') }}</p>
@endsection
