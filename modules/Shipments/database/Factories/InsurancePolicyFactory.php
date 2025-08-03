<?php

namespace Modules\Shipments\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Shipments\src\Entities\InsurancePolicy;

class InsurancePolicyFactory extends Factory
{
    protected $model = InsurancePolicy::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'coverage_rate' => fake()->numberBetween(5, 95),
            'premium_factor' => fake()->randomFloat(2, 5, 10),
            'description' => fake()->text(),
        ];
    }
}
