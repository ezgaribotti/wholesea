<?php

namespace Modules\Orders;

use App\Traits\SetupModule;
use Illuminate\Support\ServiceProvider;
use Modules\Orders\src\Interfaces\OrderRepositoryInterface;
use Modules\Orders\src\Repositories\OrderRepository;
use Modules\Orders\src\Interfaces\ProductRepositoryInterface;
use Modules\Orders\src\Repositories\ProductRepository;

class OrderServiceProvider extends ServiceProvider
{
    use SetupModule;

    public function register(): void
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    public function boot(): void
    {
        $this->defaultSetup(__DIR__);
    }
}
