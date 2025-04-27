<?php

namespace Modules\Payments;

use App\Providers\ModuleServiceProvider as Module;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Module::setup($this);
    }
}
