<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class DateTime extends Field
{
    protected string $type = 'datetime';

    public function format(string $format): self
    {
        $this->props['format'] = $format;

        return $this;
    }
}
