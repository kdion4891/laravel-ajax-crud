<div class="form-group">
    <label>{{ $field->label }}</label>
    <div class="custom-control custom-{{ $field->input_type }}">
        <input type="hidden" name="{{ $field->name }}" value="0">
        <input type="checkbox" name="{{ $field->name }}" id="{{ $field->name }}" class="custom-control-input"
               value="1" {{ $model->{$field->name} ? 'checked' : null }} data-error-input="{{ $field->name }}">
        <label for="{{ $field->name }}" class="custom-control-label">{{ $field->input_label ? $field->input_label : $field->label }}</label>
    </div>
    <div class="invalid-feedback" data-error-feedback="{{ $field->name }}"></div>
</div>
