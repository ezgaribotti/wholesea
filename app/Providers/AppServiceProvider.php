<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Faker\Provider\Base as Faker;
use Faker\Generator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute($request->user() ? 60 : 15);
        });

        // For your use in the factories

        $faker = fake();
        $faker->addProvider(new class($faker) extends Faker {
            public function randomDecimal(int $minimum = 10000): float {
                return $this->generator->randomFloat(2, $minimum, $minimum * 2);
            }
        });
        app()->singleton(Generator::class, fn() => $faker);
    }
}
