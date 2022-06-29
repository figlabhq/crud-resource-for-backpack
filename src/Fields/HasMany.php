<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class HasMany extends Field
{
    protected string $type = 'relationship';

    public function entity(string $entity): self
    {
        $this->props['entity'] = $entity;

        return $this;
    }

    public function model(string $model): self
    {
        $this->props['model'] = $model;

        return $this;
    }

    public function attribute(string $attribute): self
    {
        $this->props['attribute'] = $attribute;

        return $this;
    }

    public function subFields(array $fields): self
    {
        $this->props['subfields'] = $fields;

        return $this;
    }

    public function tab(string $tab = 'General'): self
    {
        $this->props['tab'] = $tab;

        return $this;
    }

    public function wrapperClass(string $class): self
    {
        $this->props['wrapper']['class'] = $class;

        return $this;
    }
}
