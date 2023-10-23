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

    public function selectGrouped(): self
    {
        $this->type = 'select_grouped';

        return $this;
    }

    public function groupBy(string $groupBy): self
    {
        $this->props['group_by'] = $groupBy;

        return $this;
    }

    public function groupByAttribute(string $groupByAttribute): self
    {
        $this->props['group_by_attribute'] = $groupByAttribute;

        return $this;
    }

    public function groupByRelationshipBack(string $relationship): self
    {
        $this->props['group_by_relationship_back'] = $relationship;

        return $this;
    }
}
