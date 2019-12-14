[Index](readme.md) > JSON Responses

# JSON Responses

All of the buttons and forms inside of LAC use JSON responses which are retrieved via AJAX calls.

JSON responses are specified as a `return` in your controller methods e.g.:

    public function store(Request $request)
    {
        $this->model->create($request->all());

        return response()->json([
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

There are a number of built-in JSON responses you can use.

### `redirect`

Redirects the user to the specified URL.

    'redirect' => route('home'),
   
### `reload_page`

Reloads the current page.

    'reload_page' => true,
    
### `reload_datatables`

Reloads the datatables on the current page. Useful for updating new row data.

    'reload_datatables' => true
    
### `show_alert`

Briefly flashes a bootstrap alert.

    'show_alert' => ['success', 'I have the power!']
    
The first array element is the bootstrap class e.g. `success`, `error`, etc. 

The second array element is the message to display.
    
### `show_modal`

Shows a bootstrap modal using the provided URL.

    'show_modal' => route('vehicles.insurance')
    
If you want to use a custom modal, you can simply extend the LAC modal layout in your view e.g.:

    @extends('lac::layouts.modal')
    
    @section('title', __('Custom Modal'))
    @section('child-content')
        <div class="modal-body">
            <p>{{ __(Check me out, I'm a custom modal!) }}</p>
        </div>
        <div class="modal-footer bg-light">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        </div>
    @endsection
    
### `dismiss_modal`

Dismisses the currently open AJAX bootstrap modal.

    'dismiss_modal' => true
    
### `jquery`

Allows you to perform custom jQuery calls with content retrieved via the controller method. For example, check out how the verification trait replaces the form with a message once an email is sent:

    'jquery' => [
        'selector' => '#auth-verify-form',
        'method' => 'replaceWith',
        'content' => view('lac::auth.verify-resent')->render(),
    ],

Just ensure that the `jquery` key is all lower case in your code.

You can use any jQuery method you want which uses a selector, method, and content. Examples include `append`, `prepend`, `replaceWith`, etc.

### Custom Responses

If you need to create your own JSON responses, this can be done by adding your own JS:

    $(document).ajaxComplete(function (event, xhr, settings) {
        if (xhr.hasOwnProperty('responseJSON') && xhr.responseJSON.hasOwnProperty('do_my_function')) {
            console.log(xhr.responseJSON.do_my_function);
        }
    });
    
In this example, `do_my_function` would be the JSON response key:

    return response()->json([
        'do_my_function' => 'Hello, world!',
    ]);
    
Executing this response would log `Hello, world!` in the console.

You can add your own CSS & JS in the `public/css/custom.css` and `public/js/custom.js` files.
