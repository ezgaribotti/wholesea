<?php

namespace Modules\Shipments;

use App\Traits\SetupModule;
use Illuminate\Support\ServiceProvider;

class ShipmentServiceProvider extends ServiceProvider
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
