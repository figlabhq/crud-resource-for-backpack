<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class Upload extends Field
{
    protected string $type = 'upload';

    public function isUpload(bool $upload = true): self
    {
        $this->props['upload'] = $upload;

        return $this;
    }

    public function disk(string $disk): self
    {
        $this->props['disk'] = $disk;

        return $this;
    }

    public function temporary(int $temporary = 10): self
    {
        $this->props['temporary'] = $temporary;

        return $this;
    }
}
