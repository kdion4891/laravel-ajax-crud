<div class="form-group">
    <label for="{{ $field->name }}">{{ $field->label }}</label>
    <input type="{{ $field->input_type }}" name="{{ $field->name }}" id="{{ $field->name }}" class="form-control"
           value="{{ $model->{$field->name} }}" data-error-input="{{ $field->name }}">
    <div class="invalid-feedback" data-error-feedback="{{ $field->name }}"></div>
</div>
