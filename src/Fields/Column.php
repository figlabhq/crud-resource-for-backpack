<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class Column extends Field
{
    protected string $type = 'text';

    protected bool $showOnIndex = true;
    protected bool $showOnDetail = false;
    protected bool $showOnCreation = false;
    protected bool $showOnUpdate = false;
}
