<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class Select extends Field
{
    protected string $type = 'select_from_array';

    public function select2(): self
    {
        $this->type = 'select2_from_array';

        return $this;
    }

    public function options(array $options): self
    {
        $this->props['options'] = $options;

        return $this;
    }
}
