<?php

namespace Modules\Shipments;

use App\Providers\ModuleServiceProvider as Module;
use Illuminate\Support\ServiceProvider;
use Modules\Shipments\src\Interfaces\InsurancePolicyRepositoryInterface;
use Modules\Shipments\src\Interfaces\LogisticsPointRepositoryInterface;
use Modules\Shipments\src\Interfaces\OrderRepositoryInterface;
use Modules\Shipments\src\Interfaces\PaymentRepositoryInterface;
use Modules\Shipments\src\Interfaces\ShipmentRepositoryInterface;
use Modules\Shipments\src\Interfaces\TaxRepositoryInterface;
use Modules\Shipments\src\Interfaces\TrackingStatusRepositoryInterface;
use Modules\Shipments\src\Repositories\InsurancePolicyRepository;
use Modules\Shipments\src\Repositories\LogisticsPointRepository;
use Modules\Shipments\src\Repositories\OrderRepository;
use Modules\Shipments\src\Repositories\PaymentRepository;
use Modules\Shipments\src\Repositories\ShipmentRepository;
use Modules\Shipments\src\Repositories\TaxRepository;
use Modules\Shipments\src\Repositories\TrackingStatusRepository;

class ShipmentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TaxRepositoryInterface::class, TaxRepository::class);
        $this->app->bind(LogisticsPointRepositoryInterface::class, LogisticsPointRepository::class);
        $this->app->bind(InsurancePolicyRepositoryInterface::class, InsurancePolicyRepository::class);
        $this->app->bind(ShipmentRepositoryInterface::class, ShipmentRepository::class);
        $this->app->bind(TrackingStatusRepositoryInterface::class, TrackingStatusRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    public function boot(): void
    {
        Module::setup($this);
    }
}
