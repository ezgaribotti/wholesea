<?php

namespace Modules\Orders\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Common\src\Entities\CustomerAddress;
use Modules\Common\src\Entities\Payment;
use Modules\Orders\src\Entities\Order;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'tracking_code' => Str::ulid(),
            'customer_address_id' => CustomerAddress::factory(),
            'payment_id' => Payment::factory(),
            'total_amount' => 0,
        ];
    }
}
