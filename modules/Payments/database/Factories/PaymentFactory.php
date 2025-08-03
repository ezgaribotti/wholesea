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
            'session_id' => fake()->uuid(),
            'url' => fake()->url(),
            'hosted_invoice_url' => fake()->url(),
            'total_amount' => fake()->randomFloat(2, 1000, 10000),
            'expires_at' => fake()->dateTime(),
        ];
    }
}
