<?php

namespace Modules\Payments\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Payments\src\Entities\Payment;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [];
    }
}
