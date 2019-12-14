@extends('lac::layouts.app')

@section('parent-content')
    @include('lac::layouts.nav')

    <main class="container py-4 flex-shrink-0">
        @yield('child-content')
    </main>

    @include('lac::layouts.footer')
@endsection
