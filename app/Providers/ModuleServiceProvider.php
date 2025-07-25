<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $path = base_path('module_providers.json');

        $providers = json_decode(file_get_contents($path), true);
        foreach ($providers as $provider) {
            $this->app->register($provider);
        }
    }

    public function boot(): void
    {
    }

    public static function setup(object $provider): void
    {
        $class = str_replace(chr(92), DIRECTORY_SEPARATOR, get_class($provider));
        $moduleName = lcfirst(explode(DIRECTORY_SEPARATOR, $class)[1]);

        $basePath = base_path(substr(lcfirst($class), 0, strrpos($class, DIRECTORY_SEPARATOR) + 1));

        // Default folder structure for all modules

        $provider->loadRoutesFrom($basePath . 'routes/api.php');
        $provider->loadMigrationsFrom($basePath . 'database/migrations');
        $provider->loadJsonTranslationsFrom($basePath . 'lang');
        $provider->loadViewsFrom($basePath . 'resources/views', $moduleName);

        $provider->mergeConfigFrom($basePath . 'config/config.php', $moduleName);

        if ($provider->app->runningInConsole()) {
            require $basePath . 'routes/console.php';
        }
    }

    public static function defineRoutes(callable $callback): void
    {
        $config = to_object(config('modules'));

        Route::middleware($config->middlewares)->prefix(substr($config->name, 0, -1))
            ->name($config->name)->group($callback);
    }
}
