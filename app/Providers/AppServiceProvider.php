<?php

namespace App\Providers;

use App\Interfaces\OperatorRepositoryInterface;
use App\Repositories\OperatorRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OperatorRepositoryInterface::class, OperatorRepository::class);
    }

    public function boot(): void
    {
    }
}
