<div class="form-group">
    <label>{{ $field->label }}</label>
    @foreach($field->input_options as $value => $label)
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="{{ $field->name }}[]" id="{{ $field->name . '.' . $loop->index }}" class="custom-control-input"
                   value="{{ $value }}" {{ is_array($model->{$field->name}) && in_array($value, $model->{$field->name}) ? 'checked' : null }} data-error-input="{{ $field->name }}">
            <label for="{{ $field->name . '.' . $loop->index }}" class="custom-control-label">{{ $label }}</label>
        </div>
    @endforeach
    <div class="invalid-feedback" data-error-feedback="{{ $field->name }}"></div>
</div>
