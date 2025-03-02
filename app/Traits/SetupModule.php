<?php

namespace App\Traits;

trait SetupModule
{
    public function defaultSetup(string $directory, array $commands = []): void
    {
        $path = $directory.DIRECTORY_SEPARATOR;
        $moduleName = lcfirst(basename($directory));

        $this->loadRoutesFrom($path . 'routes.php');
        $this->loadMigrationsFrom($path . 'database/migrations');
        $this->loadJsonTranslationsFrom($path . 'lang');
        $this->loadViewsFrom($path . 'templates', $moduleName);
        $this->mergeConfigFrom($path . 'config.php', $moduleName);

        if ($this->app->runningInConsole()) {
            $this->commands($commands);
        }
    }
}
