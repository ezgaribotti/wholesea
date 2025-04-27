<?php

namespace Modules\Common;

use App\Providers\ModuleServiceProvider as Module;
use Illuminate\Support\ServiceProvider;
use Modules\Common\src\Providers\EventServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
    }

    public function boot(): void
    {
        Module::setup($this);
    }
}
