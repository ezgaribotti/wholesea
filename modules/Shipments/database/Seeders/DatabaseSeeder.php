<?php

namespace Modules\Shipments\database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Shipments\src\Entities\LogisticsPoint;
use Modules\Shipments\src\Entities\Shipment;
use Modules\Shipments\src\Entities\Tax;
use Modules\Shipments\src\Entities\TrackingStatus;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['unpaid', 'unassigned', 'pending', 'in_transit', 'delivered'];

        foreach ($statuses as $name) {
            if (! TrackingStatus::whereName($name)->exists()) {
                TrackingStatus::factory()->create(['name' => $name]);
            }
        }
        Tax::factory()->create();
        LogisticsPoint::factory()->create();
        Shipment::factory()->create();
    }
}
