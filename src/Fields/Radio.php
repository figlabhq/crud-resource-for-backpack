<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class Radio extends Field
{
    protected string $type = 'radio';

    public function options(array $options): self
    {
        $this->props['options'] = $options;

        return $this;
    }

    public function inline(bool $inline = true): self
    {
        $this->props['inline'] = $inline;

        return $this;
    }
}
