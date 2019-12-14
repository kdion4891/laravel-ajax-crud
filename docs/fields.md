[Index](readme.md) > Fields

# Fields

LAC provides an expressive way to create and customize fields.

All `LacField`s are declared inside of your model `fields()` method e.g.:

    public function fields()
    {
        return [
            LacField::make('ID')
                ->tableColumn()->tableSearchable()->tableSortable()->tableOrder('desc'),

            LacField::make('Name')
                ->tableColumn()->tableSearchable()->tableSortable()
                ->input()->inputCreate()->inputEdit()
                ->rules(['required', 'min:2']),

            LacField::make('Created At')
                ->tableColumn()->tableSearchable()->tableSortable(),

            LacField::make('Updated At'),
        ];
    }

`LacField`s contain the following methods.

### `make($label, $name = '')`

This function is used to construct a field.

#### `$label`

The label for UI elements e.g. `Color`.

#### `$name`

The name of the field e.g. `color`. This represents the database column/model attribute name. If omitted, this will automatically be determined based on a snake cased `$label`.

### `tableColumn($alias = '')`

Sets the field to be present in tables.

#### `$alias`

An optional query alias. Useful for relationships.

For example, if you had a `Brand` one to many relationship with `Vehicle`, you would add your `brand` relationship to the model `$with` attribute so it is eagerly loaded. Then you would set the `$alias` for this field to `brand.name`, where `name` is the relationship column.

### `tableSearchable()`

Sets the field to be searchable in tables.

### `tableSortable()`

Sets the field to be sortable in tables.

### `tableOrder($direction = 'asc')`

Sets the field to become the default field to order by. You should only declare `tableOrder` on one field per model.

#### `$direction`

Sets the direction for default ordering. Accepts `asc` or `desc`.

### `tableHidden()`

Sets the field to be hidden inside of tables. Useful for fields you want to be searchable, but not actually visible.

### `detailsView($view = '')`

Sets a custom details view for the field. This allows you to take complete control of how the field appears in tables and the details modal.

All custom details views will be passed `$field` and `$model` objects to use e.g.:

    <i class="fa fa-circle" style="color: {{ $model->{$field->name} }}"></i>

#### `$view`

The custom blade `view()` to use e.g. `vehicles.color`

### `detailsHidden()`

Sets the field to be hidden in the details modal.

### `input($type = 'text')`

Sets the field to be a form input.

#### `$type`

The HTML5 input type e.g. `text`, `number`, `email`, `password`, etc.

### `inputFile($label = '')`

Sets the field to be a form file input.

All files are stored in the public `files` folder. Be sure to set your default `filesystems` config to `public` and `symlink` it in order to enable LAC file uploads. Then you can use `asset($model->{$field->name})` in custom details views to display things like images or link to file downloads.

If you don't want to use the public disk, you can override the `requestData()` controller method to modify this behaviour.

#### `$label`

An optional label to use for the file input. Defaults to `Choose File` if no label is specified.

### `inputTextarea($rows = 3)`

Sets the field to be a form textarea input.

#### `$rows`

The amount of rows for the textarea to have. Defaults to `3`.

### `inputSelect($options = [])`

Sets the field to be a form select input.

#### `$options`

An array of options to be used for the select. This array can be associative or sequential. If the array is associative, the array keys will be used for the select option values, and the array values for the select option labels. If the array is sequential, it's values will be used for both the select option values and labels.

For example, if your options are `['Red', 'Green', 'Blue']`, this will translate to:

	<option value="Red">Red</option>
	<option value="Green">Green</option>
	<option value="Blue">Blue</option>

If your options are `['#ff0000' => 'Red', '#00ff00' => 'Green', '#0000ff' => 'Blue']`, this will translate to:

	<option value="#ff0000">Red</option>
	<option value="#00ff00">Green</option>
	<option value="#0000ff">Blue</option>
	
If your field represents a relationship, you can use the `pluck` method to grab an array of options for that model relationship e.g.:

    $brand_options = Brand::orderBy('name')->pluck('name', 'id')->toArray();

### `inputRadio($options = [])`

Sets the field to be a form radio input.

#### `$options`

The same logic as `inputSelect` options.

### `inputCheckbox($label = '')`

Sets the field to be a single form checkbox input. Checkbox fields should have a `boolean` data type in your migrations.

#### `$label`

An optional label to use for the checkbox input. Defaults to the field label if no label is specified.

### `inputCheckboxes($options = [])`

Sets the field to have multiple form checkbox inputs. Checkboxes fields should have a `text` data type in your migrations, and a `$casts` to `array` model attribute.

#### `$options`

The same logic as `inputSelect` and `inputRadio` options.

### `inputSwitch($label = '')`

Works identical to `inputCheckbox`, but uses a switch style instead of a checkbox.

### `inputView($view = '')`

Sets a custom input view for the field. This allows you to take complete control of the field input and use any code you want. Useful for third party libraries or more complex inputs.

All custom input views will be passed `$field` and `$model` objects to use e.g.:

    <div class="form-group">
        <label for="{{ $field->name }}">{{ $field->label }}</label>
        <input type="datetime-local" name="{{ $field->name }}" id="{{ $field->name }}" class="custom-datepicker"
               value="{{ $model->{$field->name} }}" data-format="DD-MM-YYYY" data-error-input="{{ $field->name }}">
        <div class="invalid-feedback" data-error-feedback="{{ $field->name }}"></div>
    </div>

#### `$view`

The custom blade `view()` to use e.g. `vehicles.fields.datepicker`

### `inputCreate()`

Sets the field input to be visible in the create modal.

### `inputEdit()`

Sets the field input to be visible in the edit modal.

### `rules($rules = [])`

The global validation rules for the field. These rules apply when the model is being created or edited.

#### `$rules`

An array of Laravel validation rules e.g. `['required', Rule::in(['Red', 'Green', 'Blue'])]`

### `rulesCreate($rules = [])`

The validation rules to use when the model is being created.

### `rulesEdit($rules = [])`

The validation rules to use when the model is being edited.

### Model Example

    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Validation\Rule;
    use Kdion4891\Lac\Components\LacField;
    use Kdion4891\Lac\Traits\LacModel;
    
    class Vehicle extends Model
    {
        use LacModel;
    
        protected $casts = ['features' => 'array'];
        protected $with = ['brand'];
    
        public function brand()
        {
            return $this->belongsTo(Brand::class);
        }
    
        public function fields()
        {
            $brand_options = Brand::orderBy('name')->pluck('name', 'id')->toArray();
            $color_options = ['Black', 'Red', 'Green', 'Blue'];
            $fuel_options = ['Gas', 'Diesel', 'Electric'];
            $features_options = ['Bluetooth', 'Cruise Control', 'Navigation', 'Power Windows'];
    
            return [
                LacField::make('ID')
                    ->tableColumn()->tableSearchable()->tableSortable()->tableOrder('desc'),
    
                LacField::make('Brand', 'brand_id')
                    ->detailsView('vehicles.brand')
                    ->tableColumn('brand.name')->tableSearchable()->tableSortable()
                    ->inputSelect($brand_options)->inputCreate()->inputEdit()
                    ->rules(['required', Rule::exists('brands', 'id')]),
    
                LacField::make('Model')
                    ->tableColumn()->tableSearchable()->tableSortable()
                    ->input()->inputCreate()->inputEdit()
                    ->rules(['required', 'min:2']),
    
                LacField::make('Color')
                    ->detailsView('vehicles.color')
                    ->tableColumn()->tableSearchable()->tableSortable()
                    ->inputSelect($color_options)->inputCreate()->inputEdit()
                    ->rules(['required', Rule::in($color_options)]),
    
                LacField::make('Photo')
                    ->detailsView('vehicles.photo')
                    ->tableColumn()
                    ->inputFile('Choose Photo')->inputCreate()->inputEdit()
                    ->rules(['image'])->rulesCreate(['required'])->rulesEdit(['nullable']),
    
                LacField::make('Fuel Type', 'fuel')
                    ->tableColumn()->tableSearchable()->tableSortable()
                    ->inputRadio($fuel_options)->inputCreate()->inputEdit(),
    
                LacField::make('Features')
                    ->inputCheckboxes($features_options)->inputCreate()->inputEdit(),
    
                LacField::make('Created At')
                    ->tableColumn()->tableSearchable()->tableHidden(),
    
                LacField::make('Updated At')
                    ->detailsHidden(),
            ];
        }
    }
    
This example is used in the [screenshots](https://imgur.com/a/uo1ZST5).
