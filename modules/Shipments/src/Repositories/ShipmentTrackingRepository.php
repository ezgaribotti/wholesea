<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Shipments\src\Entities\ShipmentTracking;
use Modules\Shipments\src\Interfaces\ShipmentTrackingRepositoryInterface;

class ShipmentTrackingRepository extends Repository implements ShipmentTrackingRepositoryInterface
{
    public function __construct(ShipmentTracking $tracking)
    {
        parent::__construct($tracking);
    }
}
