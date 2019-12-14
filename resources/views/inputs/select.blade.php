<div class="form-group">
    <label for="{{ $field->name }}">{{ $field->label }}</label>
    <select name="{{ $field->name }}" id="{{ $field->name }}" class="custom-select" data-error-input="{{ $field->name }}">
        <option value=""></option>
        @foreach($field->input_options as $value => $label)
            <option value="{{ $value }}" {{ $model->{$field->name} == $value ? 'selected' : null }}>{{ $label }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback" data-error-feedback="{{ $field->name }}"></div>
</div>
