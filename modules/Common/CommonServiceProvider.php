<?php

namespace Modules\Common;

use App\Traits\SetupModule;
use Illuminate\Support\ServiceProvider;
use Modules\Common\src\Providers\EventServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    use SetupModule;

    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
    }

    public function boot(): void
    {
        $this->defaultSetup(__DIR__);
    }
}
