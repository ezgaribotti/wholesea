<?php

namespace Modules\Shipments;

use App\Traits\SetupModule;
use Illuminate\Support\ServiceProvider;
use Modules\Shipments\src\Interfaces\PaymentRepositoryInterface;
use Modules\Shipments\src\Interfaces\ShipmentItemRepositoryInterface;
use Modules\Shipments\src\Interfaces\ShipmentRepositoryInterface;
use Modules\Shipments\src\Interfaces\ShipmentTrackingRepositoryInterface;
use Modules\Shipments\src\Interfaces\TrackingStatusRepositoryInterface;
use Modules\Shipments\src\Repositories\PaymentRepository;
use Modules\Shipments\src\Repositories\ShipmentItemRepository;
use Modules\Shipments\src\Repositories\ShipmentRepository;
use Modules\Shipments\src\Repositories\ShipmentTrackingRepository;
use Modules\Shipments\src\Repositories\TrackingStatusRepository;

class ShipmentServiceProvider extends ServiceProvider
{
    use SetupModule;

    public function register(): void
    {
        $this->app->bind(ShipmentRepositoryInterface::class, ShipmentRepository::class);
        $this->app->bind(ShipmentItemRepositoryInterface::class, ShipmentItemRepository::class);
        $this->app->bind(TrackingStatusRepositoryInterface::class, TrackingStatusRepository::class);
        $this->app->bind(ShipmentTrackingRepositoryInterface::class, ShipmentTrackingRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
    }

    public function boot(): void
    {
        $this->defaultSetup(__DIR__);
    }
}
