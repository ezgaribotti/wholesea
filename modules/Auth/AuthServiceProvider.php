<?php

namespace Modules\Auth;

use App\Providers\ModuleServiceProvider as Module;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\src\Interfaces\LinkRepositoryInterface;
use Modules\Auth\src\Interfaces\OperatorRepositoryInterface;
use Modules\Auth\src\Interfaces\PasswordResetTokenRepositoryInterface;
use Modules\Auth\src\Interfaces\PermissionRepositoryInterface;
use Modules\Auth\src\Repositories\LinkRepository;
use Modules\Auth\src\Repositories\OperatorRepository;
use Modules\Auth\src\Repositories\PasswordResetTokenRepository;
use Modules\Auth\src\Repositories\PermissionRepository;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OperatorRepositoryInterface::class, OperatorRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(PasswordResetTokenRepositoryInterface::class, PasswordResetTokenRepository::class);
        $this->app->bind(LinkRepositoryInterface::class, LinkRepository::class);
    }

    public function boot(): void
    {
        Module::setup($this);
    }
}
