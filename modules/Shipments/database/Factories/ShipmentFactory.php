<?php

namespace Modules\Shipments\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\src\Entities\Order;
use Modules\Shipments\src\Entities\CargoManifest;
use Modules\Shipments\src\Entities\InsurancePolicy;
use Modules\Shipments\src\Entities\Shipment;
use Modules\Shipments\src\Entities\TrackingStatus;

class ShipmentFactory extends Factory
{
    protected $model = Shipment::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'tracking_status_id' => TrackingStatus::factory(),
            'cargo_manifest_id' => CargoManifest::factory(),
            'insurance_policy_id' => InsurancePolicy::factory(),
            'weight' => fake()->randomFloat(2, 10, 100),
            'shipping_cost' => fake()->randomFloat(2, 1000, 10000),
        ];
    }
}
