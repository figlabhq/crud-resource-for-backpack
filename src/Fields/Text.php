<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class Text extends Field
{
    protected string $type = 'text';

    /**
     * Character limit in column display, default is 50.
     */
    public function limit(int $limit): self
    {
        $this->props['limit'] = $limit;

        return $this;
    }
}
