<?php

namespace Modules\Common;

use App\Traits\SetupModule;
use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    use SetupModule;

    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->defaultSetup(__DIR__);
    }
}
