<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

use Illuminate\Support\Str;

abstract class Field
{
    /**
     * The displayable name of the field.
     */
    protected string $name;

    /**
     * The type of the field.
     */
    protected string $type;

    /**
     * The attribute / column name of the field.
     */
    protected string $attribute;

    /**
     * The grid size to use to display the field.
     */
    protected int $gridSize = 12;

    /**
     * The default value of the field.
     */
    protected mixed $default = null;

    /**
     * The tab name to display the field (optional).
     */
    protected ?string $tabName = null;

    /**
     * The prefix to show before the field (optional).
     */
    protected ?string $prefix = null;

    /**
     * The suffix to display after the field (optional).
     */
    protected ?string $suffix = null;

    /**
     * The help text to display below the field (optional).
     */
    protected ?string $help = null;

    /**
     * The placeholder text to display within the field (optional).
     */
    protected ?string $placeholder = null;

    /**
     * Indicates if the field should be sortable.
     */
    protected bool $sortable = false;

    /**
     * Indicates if the field should be readonly.
     */
    protected bool $readonly = false;

    /**
     * Indicates if the field should be disabled.
     */
    protected bool $disabled = false;

    /**
     * Indicates if the element should be shown on the index view.
     */
    protected bool $showOnIndex = true;

    /**
     * Indicates if the element should be shown on the detail view.
     */
    protected bool $showOnDetail = true;

    /**
     * Indicates if the element should be shown on the creation view.
     */
    protected bool $showOnCreate = true;

    /**
     * Indicates if the element should be shown on the update view.
     */
    protected bool $showOnUpdate = true;

    /**
     * The callback to be used to resolve the field's display value.
     */
    protected \Closure $displayCallback;

    /**
     * The definition of the field to return.
     */
    protected array $props = [];

    /**
     * Private constructor to avoid direct instance creation
     */
    final private function __construct(string $name, ?string $attribute = null)
    {
        $this->name = $name;
        $this->attribute = $attribute ?? str_replace(' ', '_', Str::lower($name));
    }

    /**
     * Create an instance of this field
     */
    public static function make(...$arguments): static
    {
        return new static(...$arguments);
    }

    /**
     * Default value for the field.
     */
    public function default(string | bool | int | null $value): self
    {
        $this->default = $value;

        return $this;
    }

    /**
     * Set custom attributes for the field.
     */
    public function attributes(array $attributes = []): self
    {
        $this->props['attributes'] = array_merge($this->props['attributes'], $attributes);

        return $this;
    }

    /**
     * The grid size to display the field in.
     */
    public function size(int $gridSize): self
    {
        $this->gridSize = $gridSize;

        return $this;
    }

    /**
     * In which tab this field should be displayed.
     */
    public function showInTab(string $tabName): self
    {
        $this->tabName = $tabName;

        return $this;
    }

    /**
     * The prefix to show before the field.
     */
    public function prefix(string $value): self
    {
        $this->prefix = $value;

        return $this;
    }

    /**
     * The suffix to show after the field.
     */
    public function suffix(string $value): self
    {
        $this->tabName = $value;

        return $this;
    }

    /**
     * The help text to show below the field.
     */
    public function help(string $value): self
    {
        $this->help = $value;

        return $this;
    }

    /**
     * The placeholder text to show in the field.
     */
    public function placeholder(string $value): self
    {
        $this->placeholder = $value;

        return $this;
    }

    /**
     * Specify that this field should be sortable.
     */
    public function sortable(bool $value = true): self
    {
        $this->sortable = $value;

        return $this;
    }

    /**
     * Specify that this field should be readonly.
     */
    public function readonly(bool $value = true): self
    {
        $this->readonly = $value;

        return $this;
    }

    /**
     * Specify that this field should be disabled.
     */
    public function disabled(bool $value = true): self
    {
        $this->disabled = $value;

        return $this;
    }

    /**
     * Define the callback that should be used to display the field's value.
     */
    public function displayUsing(callable $displayCallback): self
    {
        $this->displayCallback = $displayCallback;

        return $this;
    }

    /**
     * Specify that the element should be hidden from the index view.
     */
    public function hideFromIndex(bool $value = true): self
    {
        $this->showOnIndex = ! $value;

        return $this;
    }

    /**
     * Specify that the element should be hidden from the detail view.
     */
    public function hideFromDetail(bool $value = true): self
    {
        $this->showOnDetail = $value;

        return $this;
    }

    /**
     * Specify that the element should be hidden from the creation view.
     */
    public function hideWhenCreating(bool $value = true): self
    {
        $this->showOnCreate = $value;

        return $this;
    }

    /**
     * Specify that the element should be hidden from the update view.
     */
    public function hideWhenUpdating(bool $value = true): self
    {
        $this->showOnUpdate = $value;

        return $this;
    }

    /**
     * Specify that the element should not be hidden from the index view.
     */
    public function showOnIndex(bool $callback = true): self
    {
        $this->showOnIndex = $callback;

        return $this;
    }

    /**
     * Specify that the element should not be hidden from the detail view.
     */
    public function showOnDetail(bool $callback = true): self
    {
        $this->showOnDetail = $callback;

        return $this;
    }

    /**
     * Specify that the element should not be hidden from the creation view.
     */
    public function showOnCreating(bool $callback = true): self
    {
        $this->showOnCreate = $callback;

        return $this;
    }

    /**
     * Specify that the element should not be hidden from the update view.
     */
    public function showOnUpdating(bool $callback = true): self
    {
        $this->showOnUpdate = $callback;

        return $this;
    }

    /**
     * Check for showing when updating.
     */
    public function isShownOnUpdate(): bool
    {
        return $this->showOnUpdate;
    }

    /**
     * Check showing on index.
     */
    public function isShownOnIndex(): bool
    {
        return $this->showOnIndex;
    }

    /**
     * Check showing on detail.
     */
    public function isShownOnDetail(): bool
    {
        return $this->showOnDetail;
    }

    /**
     * Check for showing when creating.
     */
    public function isShownOnCreate(): bool
    {
        return $this->showOnCreate;
    }

    /**
     * Specify that the element should only be shown on the index view.
     */
    public function onlyOnIndex(): self
    {
        $this->showOnIndex = true;
        $this->showOnDetail = false;
        $this->showOnCreate = false;
        $this->showOnUpdate = false;

        return $this;
    }

    /**
     * Specify that the element should only be shown on the detail view.
     */
    public function onlyOnDetail(): self
    {
        $this->showOnIndex = false;
        $this->showOnDetail = true;
        $this->showOnCreate = false;
        $this->showOnUpdate = false;

        return $this;
    }

    /**
     * Specify that the element should only be shown on forms.
     */
    public function onlyOnForms(): self
    {
        $this->showOnIndex = false;
        $this->showOnDetail = false;
        $this->showOnCreate = true;
        $this->showOnUpdate = true;

        return $this;
    }

    /**
     * Specify that the element should be hidden from forms.
     */
    public function exceptOnForms(): self
    {
        $this->showOnIndex = true;
        $this->showOnDetail = true;
        $this->showOnCreate = false;
        $this->showOnUpdate = false;

        return $this;
    }

    /**
     * Return the Backpack column definition, after merging with existing properties from inherited field.
     */
    public function columnDefinition(): array
    {
        $props = [
            'name' => $this->attribute,
            'label' => $this->name,
            'type' => $this->type,
        ];

        if (isset($this->sortable)) {
            $props['orderable'] = $this->sortable;
        }

        if (isset($this->displayCallback) && is_callable($this->displayCallback)) {
            $props['value'] = $this->displayCallback;
        }

        return array_merge($props, $this->props);
    }


    public function buildSubFields(): array
    {
        $subFields = [];

        /** @var self $field */
        foreach ($this->props['subfields'] ?? [] as $field) {
            if ($field->isShownOnCreate() || $field->isShownOnUpdate()) {
                $subFields[] =  $field->fieldDefinition();
            }
        }

        return $subFields;
    }

    /**
     * Return the Backpack field definition, after merging with existing properties from inherited field.
     */
    public function fieldDefinition(): array
    {
        $props = [
            'name' => $this->attribute,
            'label' => $this->name,
            'type' => $this->type,
            'hint' => $this->help,
            'prefix' => $this->prefix,
            'suffix' => $this->suffix,
            'attributes' => [
                'placeholder' => $this->placeholder
            ],
        ];

        if (isset($this->props['subfields'])) {
            $this->props['subfields'] = $this->buildSubFields();
        }

        if (isset($this->tabName)) {
            $props['tab'] = $this->tabName;
        }

        if (isset($this->default)) {
            $props['value'] = $this->default;
        }

        if ($this->readonly) {
            $props['attributes']['readonly'] = 'readonly';
        }

        if ($this->disabled) {
            $props['attributes']['disabled'] = 'disabled';
        }

        $props['wrapper'] = ['class' => 'form-group col-md-' . $this->gridSize];

        return array_merge($props, $this->props);
    }
}
