<?php

namespace Modules\Shipments\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Shipments\src\Entities\ShippingCalculation;

class ShippingCalculationFactory extends Factory
{
    protected $model = ShippingCalculation::class;

    public function definition(): array
    {
        return [
            'tracking_code' => Str::ulid(),
            'cost' => fake()->randomFloat(2, 1000, 10000),
        ];
    }
}
