@extends('lac::layouts.modal')

@section('title', __('Create') . ' ' . $model->view_title)
@section('child-content')
    <form method="POST" action="{{ route($model->getTable() . '.store') }}" enctype="multipart/form-data" data-ajax-form>
        @csrf
        <div class="modal-body">
            @foreach($model->fields() as $field)
                @if($field->input_create)
                    @if($field->input_view)
                        @include($field->input_view)
                    @else
                        @include('lac::inputs.' . $field->input)
                    @endif
                @endif
            @endforeach
        </div>
        <div class="modal-footer bg-light">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('Save') . ' ' . $model->view_title }}</button>
        </div>
    </form>
@endsection
