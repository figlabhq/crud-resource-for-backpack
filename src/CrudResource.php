<?php declare(strict_types=1);

namespace FigLab\CrudResource;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;

abstract class CrudResource
{
    public function __construct(protected CrudPanel $crud)
    {
    }

    /** @return array<int, \FigLab\CrudResource\Fields\Field> */
    abstract public function fields(): array;

    /** @return array<int, \FigLab\CrudResource\Filters\Filter> */
    public function filters(): array
    {
        return [];
    }

    public function buildList(): void
    {
        foreach ($this->fields() as $field) {
            $field->setRequest($this->crud->getRequest())
                ->setOperation($this->crud->getCurrentOperation());

            if ($field->isShownOnIndex()) {
                $this->crud->addColumn($field->columnDefinition());
            }
        }

        foreach ($this->filters() as $filter) {
            $this->crud->filter($filter->name())
                ->label($filter->label())
                ->type($filter->type)
                ->values($filter->values())
                ->whenActive($filter->apply($this->crud));
        }
    }

    public function buildCreateForm(): void
    {
        foreach ($this->fields() as $field) {
            $field->setRequest($this->crud->getRequest())
                ->setOperation($this->crud->getCurrentOperation());

            if ($field->isShownOnCreation()) {
                $this->crud->addField($field->fieldDefinition());
            }
        }
    }

    public function buildUpdateForm(): void
    {
        foreach ($this->fields() as $field) {
            $field->setRequest($this->crud->getRequest())
                ->setOperation($this->crud->getCurrentOperation());

            if ($field->isShownOnUpdate()) {
                $this->crud->addField($field->fieldDefinition());
            }
        }
    }
}
