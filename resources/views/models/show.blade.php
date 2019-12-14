@extends('lac::layouts.modal')

@section('title', $model->view_title . ' ' . __('Details'))
@section('child-content')
    <div class="modal-body">
        @foreach($model->fields() as $field)
            @if(!$field->details_hidden)
                <div class="text-muted">
                    {{ $field->label }}
                    @if($field->input == 'file' && $model->{$field->name})
                        <a href="{{ asset($model->{$field->name}) }}" target="_blank" title="{{ __('Open File') }}"><i class="fa fa-paperclip"></i></a>
                    @endif
                </div>
                <div class="mb-3">
                    @if($field->details_view)
                        @include($field->details_view)
                    @else
                        @if(is_array($model->{$field->name}))
                            {{ implode(', ', $model->{$field->name}) }}
                        @else
                            {{ !is_null($model->{$field->name}) ? $model->{$field->name} : __('N/A') }}
                        @endif
                    @endif
                </div>
            @endif
        @endforeach
    </div>
    <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
    </div>
@endsection
