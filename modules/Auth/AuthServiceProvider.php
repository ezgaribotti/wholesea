<?php

namespace Modules\Auth;

use App\Traits\SetupModule;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\src\Interfaces\OperatorRepositoryInterface;
use Modules\Auth\src\Repositories\OperatorRepository;

class AuthServiceProvider extends ServiceProvider
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
