<?php

namespace Modules\Shipments\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\src\Entities\Country;
use Modules\Shipments\src\Entities\LogisticsPoint;
use Modules\Shipments\src\Entities\TransportType;

class LogisticsPointFactory extends Factory
{
    protected $model = LogisticsPoint::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'country_id' => Country::factory(),
            'transport_type_id' => TransportType::factory(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'service_fee' => fake()->randomFloat(2, 1000, 10000),
        ];
    }
}
