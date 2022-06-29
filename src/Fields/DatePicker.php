<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class DatePicker extends Field
{
    protected string $type = 'date_picker';
    protected bool $showOnIndex = false;
    protected bool $showOnDetail = false;

    public function format(string $format): self
    {
        $this->props['format'] = $format;

        return $this;
    }
}
