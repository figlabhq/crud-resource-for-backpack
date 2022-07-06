# Defining Crud Resource

It's super easy to create a CrudResource for your model. To get started, we suggest creating a `CrudResources` directory
within your **app** folder and creating the resource classes there. 

To start with, all you need is to create a class that extends the `\FigLab\CrudResource\CrudResource` abstract class and
define the `fields()` method. 

Here's an example for the default `User` model that comes pre-installed with Laravel: 

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

Now, to use this CrudResource, you need to configure your controller accordingly. Here's the `UserController.php` that
shows how to do it: 

```php
<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\CrudResources\User\UserCrudResource;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

class UserCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    
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
