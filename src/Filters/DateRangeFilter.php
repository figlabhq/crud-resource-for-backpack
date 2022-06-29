<?php declare(strict_types=1);

namespace FigLab\CrudResource\Filters;

abstract class DateRangeFilter extends Filter
{
    public string $type = 'date_range';
}
