<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class Repeatable extends Field
{
    public function subFields(array $fields): self
    {
        $this->props['subfields'] = $fields;

        return $this;
    }
}
