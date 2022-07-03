# Fluent Interface for Laravel Backpack

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![The Whole Fruit Manifesto](https://img.shields.io/badge/writing%20standard-the%20whole%20fruit-brightgreen)](https://github.com/the-whole-fruit/manifesto)

This package allows creating CRUD panels for [Backpack for Laravel](https://backpackforlaravel.com/) administration panel using fluent field definitions.

This is heavily inspired by [Laravel Nova](https://nova.laravel.com/).

### What does it offer?
- Define Resources once, get all configurations ready for CRUD panels
- Get IDE hints - these are all PHP classes :wink:
- Avoid looong, nested, boring arrays
- Embrace eligance of Object-Oriented API with [Fluent Interface Pattern](https://en.wikipedia.org/wiki/Fluent_interface) 


## Installation

Via Composer

``` bash
composer require figlabhq/crud-resource-for-backpack
```

## Usage

1. Create a new class defining the fields required for your model. Here is how it'd look for standard Laravel User model:
    
    ```php
    <?php declare(strict_types=1);

    namespace App\CrudResources;

    use FigLab\CrudResource\CrudResource;
    use App\Models\User;
    use FigLab\CrudResource\Fields\Email;
    use FigLab\CrudResource\Fields\Password;
    use FigLab\CrudResource\Fields\Select;
    use FigLab\CrudResource\Fields\Text;
    
    class UserCrudResource extends CrudResource
    {
        public function fields(): array
        {
            return [
                Text::make('Name')
                    ->sortable(),
    
                Email::make('Email'),
    
                Password::make('Password')
                    ->size(6)
                    ->onlyOnForms(),
    
                Password::make('Confirm Password', 'password_confirmation')
                    ->size(6)
                    ->onlyOnForms(),
            ];
        }
    }
    
    ```
2. In your Crud controller, call the relevant methods:

    ```php
    <?php declare(strict_types=1);
    
    namespace App\Http\Controllers;
    
    use App\CrudResources\User\UserCrudResource;
    
    class UserCrudController extends CrudController
    {
        private UserCrudResource $crudResource;
    
        public function setup()
        {
            $this->crud->setModel(\App\Models\User::class);
            $this->crud->setRoute(config('backpack.base.route_prefix') . '/users');
            $this->crud->setEntityNameStrings('user', 'users');
    
            $this->crudResource = new UserCrudResource($this->crud);
        }
    
        protected function setupListOperation(): void
        {
            $this->crudResource->buildList();
        }
        
        protected function setupCreateOperation(): void
        {
            $this->crud->setValidation(UserStoreRequest::class);
    
            $this->crudResource->buildCreateForm();
        }
        
        protected function setupUpdateOperation(): void
        {
            $this->crud->setValidation(UserUpdateRequest::class);
    
            $this->crudResource->buildUpdateForm();
        }
    }
    ```

4. Enjoy a fully-functional CRUD panel 🎉

    ![User Listing](https://user-images.githubusercontent.com/171715/176384391-7288e693-19a7-4553-8eb2-46807c05acf8.png)
    
    ![User Create/Update](https://user-images.githubusercontent.com/171715/176384365-ca5e6d44-d634-43a8-b1ca-9a2b8edcdf80.png)

## Documentation

Coming soon...stay tuned 😅

## Change log

Changes are documented here on Github. Please see the [Releases tab](https://github.com/figlabhq/crud-resource-for-backpack/releases).

## Contributing

Please see [contributing.md](contributing.md) for a todolist and how-tos.

## Security

If you discover any security related issues, please email hello@figlab.io instead of using the issue tracker.

## Credits

- [FigLab Team][link-author]
- [All Contributors][link-contributors]

## License

This project was released under MIT, so you can install it on top of any Backpack & Laravel project. Please see the 
[license file](license.md) for more information. 

However, please note that you do need Backpack installed, so you need to also abide by its [YUMMY License](https://github.com/Laravel-Backpack/CRUD/blob/master/LICENSE.md). 
That means in production you'll need a Backpack license code. You can get a free one for non-commercial use 
(or a paid one for commercial use) on [backpackforlaravel.com](https://backpackforlaravel.com).


[ico-version]: https://img.shields.io/packagist/v/figlabhq/crud-resource-for-backpack.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/figlabhq/crud-resource-for-backpack.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/figlabhq/crud-resource-for-backpack
[link-downloads]: https://packagist.org/packages/figlabhq/crud-resource-for-backpack
[link-author]: https://github.com/figlabhq
[link-contributors]: ../../contributors
