<?php

namespace App\Providers;

use App\Interfaces\CountryRepositoryInterface;
use App\Interfaces\CustomerAddressRepositoryInterface;
use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\IdentityDocumentTypeRepositoryInterface;
use App\Interfaces\OperatorRepositoryInterface;
use App\Repositories\CountryRepository;
use App\Repositories\CustomerAddressRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\IdentityDocumentTypeRepository;
use App\Repositories\OperatorRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OperatorRepositoryInterface::class, OperatorRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(IdentityDocumentTypeRepositoryInterface::class, IdentityDocumentTypeRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(CustomerAddressRepositoryInterface::class, CustomerAddressRepository::class);
    }

    public function boot(): void
    {
    }
}
