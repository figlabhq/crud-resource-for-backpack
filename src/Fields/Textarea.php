<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class Textarea extends Field
{
    protected string $type = 'textarea';

    /**
     * Character limit in column display, default is 50.
     */
    public function limit(int $limit): self
    {
        $this->props['limit'] = $limit;

        return $this;
    }
}
