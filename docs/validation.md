# Validation

There are two ways in which you can add validation rules for your model. 

### Field-level Validation Rules

You can specify the validation rules for each of the fields within your CrudResource. Here's an example: 

```php
public function fields(): array
{
    $id = $this->crud->getRequest()->input('id') ?? $this->crud->getRequest()->route('id');

    return [
        Text::make('Name')
            ->rules('required', 'min:5', 'max:255')
            ->sortable(),

        Email::make('Email')
            ->rules('required')
            ->creationRules('unique:users,email')
            ->updateRules('unique:users,email,'.$id),

        Password::make('Password')
            ->size(6)
            ->rules(['confirmed', 'min:8'])
            ->onlyOnForms(),

        Password::make('Confirm Password', 'password_confirmation')
            ->size(6)
            ->creationRules('required')
            ->onlyOnForms(),
    ];
}
```

As shown in the example, there are three methods to use:

- **rules**: adds the validation rule for both create and update forms
- **creationRules**: adds the validation rule only for create form
- **updateRules**: adds the validation rule only for update form

You can pass an array of rules, or can specify the rules as individual parameters. 

### Resource-level Validation Rules

In addition to the field-level validation, the validation rules/messages can also be added to the CrudResource itself. Example:

```php
/** @inheritDoc */
public function validationRules(): array
{
    $id = $this->crud->getRequest()->get('id') ?? $this->crud->getRequest()->route('id');

    $rules = [
        'name' => 'required|min:5|max:255',
        'role' => 'required',
    ];

    $rules['email'] = $this->crud->getOperation() === 'create'
        ? 'required|unique:users,email'
        : 'required|unique:users,email,'.$id;

    $rules['password'] = $this->crud->getOperation() === 'create'
        ? 'required|confirmed'
        : 'confirmed';

    return $rules;
}

/** @inheritDoc */
public function validationMessages(): array
{
    return [
        'name.required' => 'You gotta give it a name, man.',
        'name.min' => 'You came up short. Try more than 2 characters.',
    ];
}
```
