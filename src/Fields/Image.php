<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

final class Image extends Field
{
    protected string $type = 'image';

    public function crop(bool $crop = true): self
    {
        $this->props['crop'] = $crop;

        return $this;
    }

    public function aspectRatio(int $ratio = 1): self
    {
        $this->props['aspect_ratio'] = $ratio;

        return $this;
    }

    public function disk(string $disk): self
    {
        $this->props['disk'] = $disk;

        return $this;
    }
}
