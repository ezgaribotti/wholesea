<?php

namespace Modules\Payments;

use App\Traits\SetupModule;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    use SetupModule;

    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->defaultSetup(__DIR__);
    }
}
