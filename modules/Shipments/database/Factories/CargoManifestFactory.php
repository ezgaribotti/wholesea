<?php

namespace Modules\Shipments\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Shipments\src\Entities\CargoManifest;
use Modules\Shipments\src\Entities\TransportType;

class CargoManifestFactory extends Factory
{
    protected $model = CargoManifest::class;

    public function definition(): array
    {
        return [
            'transport_code' => fake()->uuid(),
            'transport_type_id' => TransportType::factory(),
            'coordinates' => json_encode([]),
            'max_weight' => fake()->randomFloat(2, 1000, 10000),
            'extra_handling_fee' => 100,
            'final_cost' => fake()->randomFloat(2, 1000, 10000),
            'departure_at' => fake()->dateTime(),
            'arrival_at' => fake()->dateTime(),
        ];
    }
}
