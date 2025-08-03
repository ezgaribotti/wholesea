<?php

namespace Modules\Shipments\database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\src\Entities\Country;
use Modules\Shipments\src\Entities\CargoManifest;
use Modules\Shipments\src\Entities\InsurancePolicy;
use Modules\Shipments\src\Entities\LogisticsPoint;
use Modules\Shipments\src\Entities\Shipment;
use Modules\Shipments\src\Entities\Tax;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Country::factory()->create();
        Tax::factory()->create();
        LogisticsPoint::factory()->create();
        InsurancePolicy::factory()->create();
        CargoManifest::factory()->create();
        Shipment::factory()->create();
    }
}
