<?php

namespace Modules\Shipments\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Shipments\src\Entities\TransportType;

class TransportTypeFactory extends Factory
{
    protected $model = TransportType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'deviation_factor' => fake()->randomFloat(2, 10, 20)
        ];
    }
}
