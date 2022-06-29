<?php declare(strict_types=1);

namespace FigLab\CrudResource;

use Illuminate\Support\ServiceProvider;

class AddonServiceProvider extends ServiceProvider
{
    use AutomaticServiceProvider;

    protected string $vendorName = 'figlabhq';
    protected string $packageName = 'crud-resource-for-backpack';
    protected array $commands = [];
}
