<?php

namespace Modules\Operators;

use App\Traits\SetupModule;
use Illuminate\Support\ServiceProvider;
use Modules\Operators\src\Interfaces\OperatorRepositoryInterface;
use Modules\Operators\src\Repositories\OperatorRepository;

class OperatorServiceProvider extends ServiceProvider
{
    use SetupModule;

    public function register(): void
    {
        $this->app->bind(OperatorRepositoryInterface::class, OperatorRepository::class);
    }

    public function boot(): void
    {
        $this->defaultSetup(__DIR__);
    }
}
