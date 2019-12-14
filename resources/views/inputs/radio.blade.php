<div class="form-group">
    <label>{{ $field->label }}</label>
    @foreach($field->input_options as $value => $label)
        <div class="custom-control custom-radio">
            <input type="radio" name="{{ $field->name }}" id="{{ $field->name. '.' . $loop->index }}" class="custom-control-input"
                   value="{{ $value }}" {{ $model->{$field->name} == $value || $loop->first ? 'checked' : null }} data-error-input="{{ $field->name }}">
            <label for="{{ $field->name. '.' . $loop->index }}" class="custom-control-label">{{ $label }}</label>
        </div>
    @endforeach
    <div class="invalid-feedback" data-error-feedback="{{ $field->name }}"></div>
</div>
