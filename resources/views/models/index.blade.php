@extends('lac::layouts.auth')

@section('title', Str::plural($model->view_title))
@section('child-content')
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="mb-0">@yield('title')</h1>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary" data-show-modal="{{ route($model->getTable() . '.create') }}">
                <i class="fa fa-plus"></i> {{ __('Create') }} <span class="d-none d-md-inline-block">{{ $model->view_title }}</span>
            </button>
            @if($bulk_actions = $model->bulkActions())
                <div class="dropdown d-none d-md-inline-block">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-check-square"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach($bulk_actions as $bulk_action)
                            <form method="POST" action="{{ route($model->getTable() . '.bulk', $bulk_action->method) }}" data-ajax-form>
                                @csrf
                                <input type="hidden" name="ids" data-checkbox-ids>
                                <button type="submit" class="dropdown-item" {!! $bulk_action->confirm ? 'data-confirm="' . $bulk_action->confirm_message . '"' : null !!}>
                                    {{ $bulk_action->label }}
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    {!! $html->table() !!}
@endsection

@push('scripts')
    {!! $html->scripts() !!}
@endpush
