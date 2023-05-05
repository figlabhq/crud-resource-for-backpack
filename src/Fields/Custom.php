<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class Custom extends Field
{
    /**
     * The custom field type.
     */
    public function type(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Any additional options for the custom field, will be merged with props.
     */
    public function options(array $options = []): self
    {
        $this->props['options'] = $options;

        return $this;
    }
}
