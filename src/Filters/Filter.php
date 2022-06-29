<?php declare(strict_types=1);

namespace FigLab\CrudResource\Filters;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Illuminate\Support\Str;

abstract class Filter
{
    /**
     * The query parameter name of the filter.
     */
    public string $name;

    /**
     * The label of the filter.
     */
    public string $label;

    /**
     * The type of the filter.
     */
    public string $type;

    abstract public function apply(CrudPanel $crudPanel): \Closure;

    public function name(): string
    {
        if (isset($this->name)) {
            return $this->name;
        }

        return (string) Str::of(get_class($this))
            ->classBasename()
            ->replace('Filter', '')
            ->snake();
    }

    public function label(): string
    {
        if (isset($this->label)) {
            return $this->label;
        }

        return (string) Str::of(get_class($this))
            ->classBasename()
            ->replace('Filter', '')
            ->snake(' ')
            ->title();
    }

    public function values(): ?array
    {
        return null;
    }
}
