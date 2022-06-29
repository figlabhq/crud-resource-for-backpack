<?php declare(strict_types=1);

namespace FigLab\CrudResource\Fields;

use Illuminate\Database\Eloquent\Model;

final class Select2Ajax extends Field
{
    protected string $type = 'select2_from_ajax';

    public function options(array $options): self
    {
        $this->props['options'] = $options;

        return $this;
    }

    public function model(string | Model $options): self
    {
        $this->props['model'] = $options;

        return $this;
    }

    public function attribute(string $attribute): self
    {
        $this->props['attribute'] = $attribute;

        return $this;
    }

    public function dataSource(string $dataSource): self
    {
        $this->props['data_source'] = $dataSource;

        return $this;
    }

    public function delay(int $delay): self
    {
        $this->props['delay'] = $delay;

        return $this;
    }

    public function minInputLength(int $length): self
    {
        $this->props['minimum_input_length'] = $length;

        return $this;
    }
}
