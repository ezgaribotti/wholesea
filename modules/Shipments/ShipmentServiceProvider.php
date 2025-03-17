<?php

namespace Modules\Shipments;

use App\Traits\SetupModule;
use Illuminate\Support\ServiceProvider;
use Modules\Shipments\src\Interfaces\ShipmentItemRepositoryInterface;
use Modules\Shipments\src\Interfaces\ShipmentRepositoryInterface;
use Modules\Shipments\src\Interfaces\TrackingRepositoryInterface;
use Modules\Shipments\src\Interfaces\TrackingStatusRepositoryInterface;
use Modules\Shipments\src\Repositories\ShipmentItemRepository;
use Modules\Shipments\src\Repositories\ShipmentRepository;
use Modules\Shipments\src\Repositories\TrackingRepository;
use Modules\Shipments\src\Repositories\TrackingStatusRepository;

class ShipmentServiceProvider extends ServiceProvider
{
    use SetupModule;

    public function register(): void
    {
        $this->app->bind(ShipmentRepositoryInterface::class, ShipmentRepository::class);
        $this->app->bind(ShipmentItemRepositoryInterface::class, ShipmentItemRepository::class);
        $this->app->bind(TrackingStatusRepositoryInterface::class, TrackingStatusRepository::class);
        $this->app->bind(TrackingRepositoryInterface::class, TrackingRepository::class);
    }

    public function boot(): void
    {
        $this->defaultSetup(__DIR__);
    }
}
