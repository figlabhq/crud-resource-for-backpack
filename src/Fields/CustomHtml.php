<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class CustomHtml extends Field
{
    protected string $type = 'custom_html';

    protected bool $showOnIndex = false;
}
