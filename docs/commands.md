[Index](readme.md) > Commands

# Commands

### `php artisan lac:make ModelClass`

Generates scaffolding files for the new `ModelClass`.

This includes:

- Controller (`app/Http/Controllers/ModelClassController.php`)
- Model (`app/ModelClass.php`)
- Migration (`database/migrations/*_create_model_classes_table.php`)
- Nav item (inserted into `resources/views/vendor/lac/layouts/nav.blade.php`)
- Routes (inserted into `routes/web.php`)

### `php artisan lac:auth`

Integrates package auth scaffolding with Laravel auth scaffolding.

This includes:

- Traits (replaces traits in all `app/Http/Controllers/Auth` controller files)
- Routes (inserts `Auth` and `home` routes in `routes/web.php` if not already present)

### `php artisan vendor:publish --tag=TAG`

Where the `TAG` can be one of the following:

- `install` (publishes the nav view, CSS, & JS files required by LAC)
- `public` (publishes the CSS & JS files)
- `nav` (publishes the nav view file)
- `layout` (publishes the main app layout view)
- `auth` (publishes the auth views)
- `inputs` (publishes the field input component views)
- `layouts` (publishes all layout views)
- `models` (publishes the CRUD model views)
- `views` (publishes all package views)
