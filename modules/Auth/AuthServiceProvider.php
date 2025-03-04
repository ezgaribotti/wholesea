<?php

namespace Modules\Auth;

use App\Traits\SetupModule;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\src\Interfaces\OperatorRepositoryInterface;
use Modules\Auth\src\Interfaces\PermissionRepositoryInterface;
use Modules\Auth\src\Repositories\OperatorRepository;
use Modules\Auth\src\Repositories\PermissionRepository;

class AuthServiceProvider extends ServiceProvider
{
    use SetupModule;

    public function register(): void
    {
        $this->app->bind(OperatorRepositoryInterface::class, OperatorRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
    }

    public function boot(): void
    {
        $this->defaultSetup(__DIR__);
    }
}
