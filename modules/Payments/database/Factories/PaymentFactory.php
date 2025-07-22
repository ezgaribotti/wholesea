<?php

namespace Modules\Payments\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Payments\src\Entities\Payment;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'status' => 'paid',
            'tracking_code' => Str::ulid(),
            'external_reference' => fake()->uuid(),
        ];
    }
}
