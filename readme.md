![Imgur](https://i.imgur.com/Tj313Vo.jpg)

# Laravel AJAX CRUD

LAC is a Laravel 6 package designed to integrate beautifully while saving you tons of time. Get a complete CRUD interface done in minutes by adding a few lines of code to your models.

**Features include:**

- Full Laravel 6 auth & resource integration
- Unobtrusive implementation to keep you in control
- Field, action, & bulk action helper classes
- Scaffolding command to create files for you
- Intuitive, responsive UI design
- AJAX validation & responses
- Ease of use and customization

**Links of interest:**

- [Docs](https://github.com/kdion4891/laravel-ajax-crud/tree/master/docs/readme.md)
- [Screenshots](https://imgur.com/a/uo1ZST5)
- [Support](https://github.com/kdion4891/laravel-ajax-crud/issues)
- [Contributions](https://github.com/kdion4891/laravel-ajax-crud/pulls)
- [Buy me a coffee](https://ko-fi.com/kdion4891)

# Installation

Require the package:

    composer require kdion4891/laravel-ajax-crud
    
Publish the nav view, CSS, & JS files:

    php artisan vendor:publish --tag=install
   
Integrate the auth scaffolding:

    php artisan lac:auth
    
# Quick Start

Make scaffolding files for a new model (a `Vehicle`, for example):

    php artisan lac:make Vehicle
    
Update the `LacField`s in the new `Vehicle` model class:

    public function fields()
    {
        return [
            LacField::make('ID')
                ->tableColumn()->tableSearchable()->tableOrder('desc'),
        
            LacField::make('Brand')
                ->tableColumn()->tableSearchable()->tableSortable()
                ->input()->inputCreate()->inputEdit()
                ->rules(['required']),
        
            LacField::make('Color')
                ->tableColumn()->tableSearchable()->tableSortable()
                ->inputSelect(['Red', 'Green', 'Blue'])->inputCreate()->inputEdit(),
        
            LacField::make('Created At')
                ->tableColumn()->tableSearchable()->tableHidden(),
        
            LacField::make('Updated At')
                ->detailsHidden(),
        ];
    }

Update the new `*_create_vehicles_table` migration file with your field columns:

    Schema::create('vehicles', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('brand');
        $table->string('color')->nullable();
        $table->timestamps();
    });
    
Run the migration:

    php artisan migrate
    
Log into your app and click the `Vehicles` link in the navbar to view the CRUD.

[Learn more in the docs](https://github.com/kdion4891/laravel-ajax-crud/tree/master/docs/readme.md).
