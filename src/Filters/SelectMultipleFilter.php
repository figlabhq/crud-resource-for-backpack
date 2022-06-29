<?php declare(strict_types=1);

namespace FigLab\CrudResource\Filters;

abstract class SelectMultipleFilter extends Filter
{
    public string $type = 'select2_multiple';
}
