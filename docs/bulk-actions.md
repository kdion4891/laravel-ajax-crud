[Index](readme.md) > Bulk Actions

# Bulk Actions

Bulk actions are performed on checked rows in the model table.

All `LacBulkAction`s are declared inside of your model `bulkActions()` method e.g.:

    public function bulkActions()
    {
        return [
            LacBulkAction::make('Send Email', 'sendBulkEmail'),
            LacBulkAction::delete(),
        ];
    }
    
LAC comes with one default bulk action which can be specified:

- `delete()` (deletes the checked models)

In order to specify your own custom bulk actions, you can use the `make` function.

### `make($label = '', $method = '')`

Creates a new custom bulk action.

#### `$label`

The label to use in the bulk actions UI dropdown button e.g. `Send Email`.

#### `$method`

The model controller method to use for the bulk action e.g. `sendBulkEmail`

The controller method you specify will be passed an array of the checked model `$ids`. You must ensure the model controller contains this method in order for the custom bulk action to work.

For example, check out how the default bulk delete controller method works:

    public function destroyBulk($ids = [])
    {
        foreach ($ids as $id) {
            $this->model->findOrFail($id)->delete();
        }

        return response()->json([
            'reload_datatables' => true,
        ]);
    }
    
You can do anything you want with the model `$ids` in your custom bulk controller method.

If you want to require confirmation when the bulk action dropdown button is clicked, use the `confirm()` method:

### `confirm($message = '')`

Prompts the user for confirmation when the bulk action dropdown button is clicked e.g.:

    LacBulkAction::make('Send Email', 'sendBulkEmail')->confirm('Send emails now?')

#### `$message`

The message to display in the confirmation box. Defaults to `Are you sure?` if no message is specified.

Like actions, bulk actions are entirely optional and you can remove all bulk actions by specifying an empty array (`return []`) in the `bulkActions()` method of your model.
