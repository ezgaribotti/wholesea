<?php

namespace Modules\Products;

use App\Providers\ModuleServiceProvider as Module;
use Illuminate\Support\ServiceProvider;
use Modules\Products\src\Interfaces\CategoryRepositoryInterface;
use Modules\Products\src\Interfaces\ProductImageRepositoryInterface;
use Modules\Products\src\Interfaces\ProductRepositoryInterface;
use Modules\Products\src\Repositories\CategoryRepository;
use Modules\Products\src\Repositories\ProductImageRepository;
use Modules\Products\src\Repositories\ProductRepository;

class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductImageRepositoryInterface::class, ProductImageRepository::class);
    }

    public function boot(): void
    {
        Module::setup($this);
    }
}
