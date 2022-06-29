<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class Hidden extends Field
{
    protected string $type = 'hidden';

    protected bool $showOnIndex = false;
}
