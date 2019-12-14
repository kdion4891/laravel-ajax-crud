[Index](readme.md) > Actions

# Actions

Actions are represented in each row of the model table.

All `LacAction`s are declared inside of your model `actions()` method e.g.:

    public function actions()
    {
        return [
            LacAction::make('vehicles.actions.mark_sold'),
            LacAction::details(),
            LacAction::edit(),
            LacAction::delete(),
        ];
    }
    
LAC comes with a few default actions which can be specified:

- `details()` (shows the details button which opens the details modal)
- `edit()` (shows the edit button which opens the edit form modal)
- `delete()` (shows the delete button which deletes the model)

In order to specify your own custom actions, you can use the `make` function.

### `make($view = '')`

Creates a new custom action with any view you want.

#### `$view`

The name of the custom view to use for the action button. This view would simply contain the code for the action button itself e.g.:

    <button type="button" class="btn btn-outline-success px-2" title="{{ __('Custom Action') }}">
        <i class="fa fa-fw fa-cog"></i>
    </button>

Your button can open a modal, go to a different URL, perform a form submission, or whatever else you desire. Check the package `resources/views/models/actions` folder for examples.

Actions are entirely optional and you can remove all actions by specifying an empty array (`return []`) in the `actions()` method if need be.
