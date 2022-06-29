<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class BelongsTo extends Field
{
    protected string $type = 'select';

    public function select2(): self
    {
        $this->type = 'select2';

        return $this;
    }

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

    public function options(callable $options): self
    {
        $this->props['options'] = $options;

        return $this;
    }

    /** Workaround to prevent select2 field showing ID only */
    public function columnDefinition(): array
    {
        return array_merge(parent::columnDefinition(), [
            'type' => 'select',
        ]);
    }
}
