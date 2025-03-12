<?php

namespace Modules\Orders\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Orders\src\Entities\Payment;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [];
    }
}
