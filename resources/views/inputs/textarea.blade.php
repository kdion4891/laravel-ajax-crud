<div class="form-group">
    <label for="{{ $field->name }}">{{ $field->label }}</label>
    <textarea name="{{ $field->name }}" id="{{ $field->name }}" class="form-control" rows="{{ $field->input_rows }}"
              data-error-input="{{ $field->name }}">{{ $model->{$field->name} }}</textarea>
    <div class="invalid-feedback" data-error-feedback="{{ $field->name }}"></div>
</div>
