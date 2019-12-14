<div class="form-group">
    <label>{{ $field->label }}</label>
    @if($model->{$field->name})
        <a href="{{ asset($model->{$field->name}) }}" target="_blank" title="{{ __('Open File') }}"><i class="fa fa-paperclip"></i></a>
    @endif
    <div class="custom-file">
        <input type="file" name="{{ $field->name }}" id="{{ $field->name }}" class="custom-file-input" data-error-input="{{ $field->name }}">
        <label for="{{ $field->name }}" class="custom-file-label">{{ $field->input_label ? $field->input_label : __('Choose File') }}</label>
    </div>
    <div class="invalid-feedback" data-error-feedback="{{ $field->name }}"></div>
</div>
