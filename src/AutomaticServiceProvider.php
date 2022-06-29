<?php declare(strict_types=1);

namespace FigLab\CrudResource;

/**
 * This trait automatically loads package stuff, if they're present
 * in the expected directory. Stick to the conventions and
 * your package will "just work". Feel free to override
 * any of the methods below in your ServiceProvider
 * if you need to change the paths.
 */
trait AutomaticServiceProvider
{
    public function __construct($app)
    {
        $this->app = $app;
        $this->path = __DIR__ . '/..';
    }

    /**
     * -------------------------
     * SERVICE PROVIDER DEFAULTS
     * -------------------------
     */

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->packageDirectoryExistsAndIsNotEmpty('bootstrap') &&
            file_exists($helpers = $this->packageHelpersFile())) {
            require $helpers;
        }

        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/lang')) {
            $this->loadTranslationsFrom($this->packageLangsPath(), $this->vendorNameDotPackageName());
        }

        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/views')) {
            // Load published views
            $this->loadViewsFrom($this->publishedViewsPath(), $this->vendorNameDotPackageName());

            // Fallback to package views
            $this->loadViewsFrom($this->packageViewsPath(), $this->vendorNameDotPackageName());
        }

        if ($this->packageDirectoryExistsAndIsNotEmpty('database/migrations')) {
            $this->loadMigrationsFrom($this->packageMigrationsPath());
        }

        if ($this->packageDirectoryExistsAndIsNotEmpty('routes')) {
            $this->loadRoutesFrom($this->packageRoutesFile());
        }

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->packageDirectoryExistsAndIsNotEmpty('config')) {
            $this->mergeConfigFrom($this->packageConfigFile(), $this->vendorNameDotPackageName());
        }
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        if ($this->packageDirectoryExistsAndIsNotEmpty('config')) {
            $this->publishes([
                $this->packageConfigFile() => $this->publishedConfigFile(),
            ], 'config');
        }

        // Publishing the views.
        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/views')) {
            $this->publishes([
                $this->packageViewsPath() => $this->publishedViewsPath(),
            ], 'views');
        }

        // Publishing assets.
        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/assets')) {
            $this->publishes([
                $this->packageAssetsPath() => $this->publishedAssetsPath(),
            ], 'assets');
        }

        // Publishing the translation files.
        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/lang')) {
            $this->publishes([
                $this->packageLangsPath() => $this->publishedLangsPath(),
            ], 'lang');
        }

        // Registering package commands.
        if (! empty($this->commands)) {
            $this->commands($this->commands);
        }
    }

    /**
     * -------------------
     * CONVENIENCE METHODS
     * -------------------
     */

    protected function vendorNameDotPackageName(): string
    {
        return $this->vendorName . '.' . $this->packageName;
    }

    protected function vendorNameSlashPackageName(): string
    {
        return $this->vendorName . '/' . $this->packageName;
    }

    // -------------
    // Package paths
    // -------------

    protected function packageViewsPath(): string
    {
        return $this->path . '/resources/views';
    }

    protected function packageLangsPath(): string
    {
        return $this->path . '/resources/lang';
    }

    protected function packageAssetsPath(): string
    {
        return $this->path . '/resources/assets';
    }

    protected function packageMigrationsPath(): string
    {
        return $this->path . '/database/migrations';
    }

    protected function packageConfigFile(): string
    {
        return $this->path . '/config/' . $this->packageName . '.php';
    }

    protected function packageRoutesFile(): string
    {
        return $this->path . '/routes/' . $this->packageName . '.php';
    }

    protected function packageHelpersFile(): string
    {
        return $this->path . '/bootstrap/helpers.php';
    }

    // ---------------
    // Published paths
    // ---------------

    protected function publishedViewsPath(): string
    {
        return base_path('resources/views/vendor/' . $this->vendorName . '/' . $this->packageName);
    }

    protected function publishedConfigFile(): string
    {
        return config_path($this->vendorNameSlashPackageName() . '.php');
    }

    protected function publishedAssetsPath(): string
    {
        return public_path('vendor/' . $this->vendorNameSlashPackageName());
    }

    protected function publishedLangsPath(): string
    {
        return resource_path('lang/vendor/' . $this->vendorName);
    }

    // -------------
    // Miscellaneous
    // -------------

    protected function packageDirectoryExistsAndIsNotEmpty($name): bool
    {
        // check if directory exists
        if (! is_dir($this->path . '/' . $name)) {
            return false;
        }

        // check if directory has files
        foreach (scandir($this->path . '/' . $name) as $file) {
            if ($file != '.' && $file != '..' && $file != '.gitkeep') {
                return true;
            }
        }

        return false;
    }
}
