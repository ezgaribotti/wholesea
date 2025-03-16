<?php

namespace Modules\Orders\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\src\Entities\CustomerAddress;
use Modules\Orders\src\Entities\Order;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'tracking_number' => uniqid(),
            'customer_address_id' => CustomerAddress::factory(),
        ];
    }
}
