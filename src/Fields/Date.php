<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class Date extends Field
{
    protected string $type = 'date';

    public function format(string $format): self
    {
        $this->props['format'] = $format;

        return $this;
    }
}
