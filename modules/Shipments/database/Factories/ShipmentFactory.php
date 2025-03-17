<?php

namespace Modules\Shipments\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\src\Entities\CustomerAddress;
use Modules\Shipments\src\Entities\Shipment;

class ShipmentFactory extends Factory
{
    protected $model = Shipment::class;

    public function definition(): array
    {
        return [
            'tracking_number' => uniqid(),
            'customer_address_id' => CustomerAddress::factory(),
            'cost' => 0,
        ];
    }
}
