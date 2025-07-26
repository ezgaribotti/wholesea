<?php

namespace Modules\Shipments\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Common\src\Entities\CustomerAddress;
use Modules\Shipments\src\Entities\Shipment;
use Modules\Shipments\src\Entities\TrackingStatus;

class ShipmentFactory extends Factory
{
    protected $model = Shipment::class;

    public function definition(): array
    {
        return [
            'tracking_code' => Str::ulid(),
            'tracking_status_id' => TrackingStatus::factory(),
            'customer_address_id' => CustomerAddress::factory(),
            'cost' => 0,
        ];
    }
}
