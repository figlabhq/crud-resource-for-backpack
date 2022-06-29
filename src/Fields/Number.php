<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class Number extends Field
{
    protected string $type = 'number';

    public function min(int $min): self
    {
        $this->props['attributes']['min'] = $min;

        return $this;
    }

    public function max(int $max): self
    {
        $this->props['attributes']['max'] = $max;

        return $this;
    }

    public function step(float $step): self
    {
        $this->props['attributes']['step'] = $step;

        return $this;
    }
}
