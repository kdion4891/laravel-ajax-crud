@extends('lac::layouts.app')

@section('parent-content')
    <main class="container py-4 h-100">
        <div class="row align-items-center justify-content-center h-100">
            <div class="col-md-5">
                <h2 class="text-center mb-4">{{ config('app.name', 'Laravel') }}</h2>
                <div class="card mb-5">
                    <h5 class="card-header bg-light">@yield('title')</h5>
                    @yield('child-content')
                </div>
            </div>
        </div>
    </main>
@endsection
